<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function index()
    {
        $photo = Photo::inRandomOrder()->limit(3)->get();

        $photo->transform(function ($data){
           $data->image = asset('uploads').'/'.$data->image;
           return $data;
        });
        return response()->json([
            'result'=>$photo
        ]);
    }
}
