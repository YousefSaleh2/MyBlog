<?php

namespace App\Traits;

use App\Http\Resources\CategoryResource;

trait ApiResponseTrait
{
    public function apiResponse($data , $measseg , $status){

        $array=[
            'data'     => $data,
            'measseg'  => $measseg,
            'status'   => $status
        ];
        return response()->json($array,$status);
    }
}

