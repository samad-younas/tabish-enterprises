<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('auth.settings', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'option_name' => 'required',
            'option_value' => 'required',
        ]);
        Setting::where('created_by', Auth::user()->id)->delete();
        for ($i=0; $i < count($request->option_name); $i++) { 
            $setting = new Setting();
            $setting->created_by = Auth::user()->id;
            $setting->option_name = $request->option_name[$i];
            $setting->option_value = $request->option_value[$i];
            $setting->save();
        }
        return redirect()->route('setting.index')
            ->with('success', 'Setting created successfully');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'option_name' => 'required',
            'option_value' => 'required',
        ]);

        Setting::where('created_by', Auth::user()->id)->delete();
        for ($i=0; $i < count($request->option_name); $i++) { 
            $setting = new Setting();
            $setting->created_by = Auth::user()->id;
            $setting->option_name = $request->option_name[$i];
            $setting->option_value = $request->option_value[$i];
            $setting->save();
        }
        return redirect()->route('setting.index')
            ->with('success', 'Setting created successfully');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully');
    }
}
