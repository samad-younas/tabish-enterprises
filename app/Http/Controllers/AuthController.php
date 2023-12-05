<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Mail\NewUserEmail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function createUser(){
        return view('user.create');
    }
    public function addInvitedUser(Request $request){
        // Validate the request data (you can add more validation rules as needed)
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'dropdown' => 'required|in:reseller,customer,normal',
        ]);

        $token = Str::random(40);
        // Create a new user
        $user = new User();
        $user->email = $validatedData['email'];
        $user->type = $validatedData['dropdown'];
        $user->name = $validatedData['name'];
        $user->password = encrypt('123456');
        $user->invite_token = $token;
        $user->created_by = Auth::user()->id;
        $user->save();

        // Generate a unique token or identifier for the user
        // $token = Str::random(40); // Adjust the length as needed

        // Send an email to the user with the token and redirect link
        Mail::to($user->email)->send(new NewUserEmail($token));

        // Redirect back with a success message or customize the response as needed
        return redirect()->back()->with('status', 'User invited.');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                // dd($user->id);
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456')
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function authenticationQr(Request $request)
    {
        $qr = DB::table('google2fa_secrets')->first();
        if(empty($qr)){
            $google2fa = app('pragmarx.google2fa');
            $registration_data = $request->all();
            $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
            $email = 'abdulsamad.idenbrid@gmail.com';
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $email,
                $registration_data['google2fa_secret']
            );

            DB::table('google2fa_secrets')->insert([
                'google2fa_secret' => $registration_data['google2fa_secret'],
                'qr' => $QR_Image,
                'created_by' => 1
            ]);
        }else{
            $QR_Image = $qr->qr;
        }
        return view('auth.2fa', ['QR_Image' => $QR_Image]);
    }
    public function login2FA(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'google2faSecret' => 'required',
        ]);
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['User not found.'],
            ]);
        }
        $googleAuthenticator = app('pragmarx.google2fa');
        $qr = DB::table('google2fa_secrets')->first();
        $valid = $googleAuthenticator->verifyKey($qr->google2fa_secret, $request->input('google2faSecret'));

        if (!$valid) {
            throw ValidationException::withMessages([
                'google2fa_secret' => ['Invalid Google Authenticator code.'],
            ]);
        }
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
    public function magicLogin($token){
        $qr = DB::table('google2fa_secrets')->first();
        if(empty($qr)){
            $google2fa = app('pragmarx.google2fa');
            $registration_data = [];
            $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
            $email = 'abdulsamad.idenbrid@gmail.com';
            $QR_Image = $google2fa->getQRCodeInline(
                config('app.name'),
                $email,
                $registration_data['google2fa_secret']
            );

            DB::table('google2fa_secrets')->insert([
                'google2fa_secret' => $registration_data['google2fa_secret'],
                'qr' => $QR_Image,
                'created_by' => 1
            ]);
        }else{
            $QR_Image = $qr->qr;
        }
        $email = User::where('invite_token',$token)->value('email');
        $data = ['email'=>$email, 'QR_Image' => $QR_Image];
        return view('auth.magicLogin', compact('data'));
    }
    public function usersList(){
        if(Auth::user()->type == 'admin'){
            $users = User::whereNotIn('type', ['admin'])->get();
        }else {
            $users = User::where('created_by', Auth::user()->id)->whereNotIn('type', ['admin'])->get();
        }
        return view('user.list', ['users' => $users]);
    }
    public function userDelete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return back();
        }
    }
}
