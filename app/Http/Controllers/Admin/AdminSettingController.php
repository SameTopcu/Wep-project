<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);
        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'footer_address' => 'required',
            'footer_email' => 'required|email',
            'footer_phone' => 'required',
            'footer_copyright' => 'required',
        ]);

        $setting = Setting::firstOrCreate(['id' => 1]);
        
        $setting->footer_address = $request->footer_address;
        $setting->footer_email = $request->footer_email;
        $setting->footer_phone = $request->footer_phone;
        $setting->footer_copyright = $request->footer_copyright;
        
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->youtube = $request->youtube;
        $setting->linkedin = $request->linkedin;
        $setting->instagram = $request->instagram;
        
        $setting->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
