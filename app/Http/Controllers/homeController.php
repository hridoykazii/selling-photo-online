<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function home()
    {
        $bgImage = 'img/home-bg.jpg';
        $photos = Photo::whereNotIn('status',['pending','rejected'])->inRandomOrder()->get();

        return view('user.home',compact(['bgImage','photos']));
    }

    public function about()
    {
        return view('user.about');
    }
    public function sample()
    {
        return view('user.sample');
    }
    public function contact()
    {
        return view('user.contact');
    }
}
