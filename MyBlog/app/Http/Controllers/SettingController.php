<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use uploadImageTrait;
    public function index()
    {
        $setting = Setting::first();
        return view('admin.sitting.update' , compact('setting'));
    }

    public function update(Request $request , Setting $setting)
    {
        dd($request);
        $request->validate([
            'logo'       => ['nullable' , 'image' , 'mimes:png,jpg,jpeg,gif,sug' , 'max:2048'],
            'favicon'    => ['nullable' , 'image' , 'mimes:png,jpg,jpeg,gif,sug' , 'max:2048'],
            'facebook'   => ['nullable' ,'string'],
            'instagram'  => ['nullable' ,'string'],
            'phone'      => ['nullable' ,'string'],
            'email'      => ['nullable' ,'email'],
            'title'      => ['nullable' ,'string'],
            'content'    => ['nullable' ,'string'],
            'address'    => ['nullable' ,'string'],
        ]);
        $logo = $this->uploadImage($request , 'setting' , 'logo');
        $favicon = $this->uploadImage($request , 'setting' , 'favicon');
        $setting->update([
            'logo'       => $logo,
            'favicon'    => $favicon,
            'facebook'    => $request->facebook,
            'instagram'    => $request->instagram,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'title'    => $request->title,
            'content'    => $request->content,
            'address'    => $request->address,
        ]);
        return redirect()->route('setting')
                        ->with('success','Setting updated successfully');
    }
}
