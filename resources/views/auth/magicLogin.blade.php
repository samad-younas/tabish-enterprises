<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body" style="text-align: center;">
                        <div>
                            {!! $data['QR_Image'] !!}
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('login-2fa') }}">
        @csrf

        <!-- Email Address -->
        <input type="hidden" name="email" value="{{$data['email']}}" />
        @error('email')
            <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
        @enderror
        <div>
            <x-input-label for="google2faSecret" :value="__('OTP')" />
            <x-text-input id="google2faSecret" class="block mt-1 w-full" type="text" name="google2faSecret" :value="old('google2faSecret')" required autofocus/>
            <x-input-error :messages="$errors->get('google2faSecret')" class="mt-2" />
            @error('google2fa_secret')
                <div class="alert alert-danger" style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <!-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" /> -->
        </div>
        <!-- OTP -->
        <!-- <div class="mt-4">
            <x-input-label for="otp" :value="__('OTP')" />

            <x-text-input id="otp" class="block mt-1 w-full"
                            type="otp"
                            name="google2faSecret"
                            required autocomplete="current-otp" />

            <x-input-error :messages="$errors->get('google2faSecret')" class="mt-2" />
        </div> -->

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <x-nav-link :href="route('authenticationQr')" :active="request()->routeIs('authenticationQr')">
                {{ __('Google Authenticator') }}
            </x-nav-link>
        </div> -->
        <!-- <div class="flex items-center justify-end mt-4">
            <a href="{{ url('auth/google') }}">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
            </a>
        </div> -->
        <div class="flex items-center justify-end mt-4">
            <!-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif -->

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
