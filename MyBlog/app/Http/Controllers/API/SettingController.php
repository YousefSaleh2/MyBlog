<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Traits\ApiResponseTrait;
use App\Traits\uploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    use ApiResponseTrait , uploadImageTrait;
    public function update(Request $request, Setting  $setting)
    {
        if (!$setting) {
            return $this->apiResponse(null , 'Setting not found' , 404 );
        }

        $validator = Validator::make($request->all(), [
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


        if ($validator->fails()) {
            return $this->apiResponse(null , $validator->errors() , 400);
        }
        if (!empty($request->logo)) {

            $logo = $this->uploadImage($request , 'setting' , 'logo');
        }else {
            $logo=null;
        }

        if (!empty($request->favicon)) {

            $favicon = $this->uploadImage($request , 'setting' , 'favicon');
        }else {
            $favicon=null;
        }


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

        if ($setting) {
            return $this->apiResponse(new SettingResource($setting) , 'Setting updated successfully' , 200);
        }
        return $this->apiResponse(null , 'Setting didn\'t update successfully' , 400);
    }

}
