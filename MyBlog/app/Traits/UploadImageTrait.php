<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait uploadImageTrait
{
    public function uploadImage(Request $request , $folderName , $fileName){
        $image = time() .'.' . $request->file($fileName)->getClientOriginalName();
        $path = $request->file($fileName)->storeAs($folderName , $image ,'image' );
        return $path;
    }
}
