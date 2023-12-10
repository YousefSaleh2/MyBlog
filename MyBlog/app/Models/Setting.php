<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory ;

    protected $fillable = [
        'logo',
        'favicon',
        'facebook',
        'instagram',
        'phone',
        'email',
        'title',
        'content',
        'address',
    ];

    public static function checkSettings()
    {
        $settings = self::all();
        if (count( $settings)<1){
            $data=[
                'id' => 1
            ];
            self::create($data);
        }
        return self::first();
    }
}
