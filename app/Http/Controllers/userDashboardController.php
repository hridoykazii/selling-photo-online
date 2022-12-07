<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userDashboardController extends Controller
{
    public function index()
    {
        return view('user.udashboard');
    }

    public function upload()
    {

        $this->validate(\request(),[
            'image'=>'required|image|mimes:jpg,jpeg,png',
        ]);
        $imgName=rand().'.'.request('image')->extension();


        DB::transaction(function () use($imgName){
            User::find(Auth::id())->photos()->create([
                'name'=>\request('name'),
                'details'=>\request('details'),
                'image'=> $imgName
            ]);
        });
        \request('image')->move('uploads',$imgName);
        return redirect('/udashboard');

    }
    public function gallery()
    {
        $photos= Auth::user()->photos()->paginate(5);
        return view('user.gallery',compact('photos'));
    }
    public function submitForSell($photoID)
    {
        $photo = Photo::find($photoID);
        if ($photoID !=null && $photo->status == 'approved' && Auth::id() == $photo->user_id){
            $photo->update([
                'status' => 'selling'
            ]);
            return redirect()->back();
        }else{
            return 'invalid data';
        }
    }

    public function userFinancial()
    {
        $balance = Auth::user()->financial->balance;
        $buyOutimage= Photo::where('user_id',Auth::id())->where('status','buy-out')->get();
        return view('user.financial',compact('balance','buyOutimage'));
    }

    public function cashout($amount)
    {
        $userData = Auth::user();
        $financial = $userData->financial;
        $currentBalance = $financial->balance;

        if ($currentBalance >= $amount && $amount >= 5){
            $userData->cashouts()->create([
                'financial_id' => $financial->id,
                'amount' => $amount
            ]);
            $financial->update([
                'balance'=>0.00
            ]);
            return redirect()->back();

        }else{
            echo "need 5 usd balance for approve";
        }
    }
}
