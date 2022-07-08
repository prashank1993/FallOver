<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function SiteSettings()
    {
        # code...
        $data['title'] = 'Settings';
        $data['settings'] = Setting::select('key', 'value')
            ->pluck('value', 'key')
            ->toArray();
        return view('admin.settings', $data);
    }
    public function UpdateSetting(Request $request)
    {
        # code... 
        if ($request->file('businessLogo')) {
            $file = $request->file('businessLogo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('businessLogo/'), $filename);
            if (isset($filename)) {
                Setting::updateOrCreate(
                    ['key' => 'businessLogo'],
                    ['value' => ($filename) ? 'businessLogo/' . $filename : '']
                );
            }
        }

        $request = $request->except('_token');
        $settings = [];
        foreach ($request as $key => $value) {
            if ($value && $key != 'businessLogo') {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => ($value) ?? '']
                );
            }
        }

        return redirect()->back();
    }
}
