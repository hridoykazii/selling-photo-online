<?php

namespace App\Http\Controllers;


use App\Models\CashOut;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function showDashboard(): Factory|View|Application
    {
        $registerUser = User::all('id')->count();
        $totalCashout = CashOut::where('status','approve')->sum('amount');
        return view('dashboard',compact(['registerUser','totalCashout']));
    }
    public function approval()
    {
        $photos = Photo::with('user')->where('status','pending')->get();
//        dd($photos->toArray());
        return view('admin.approval',compact('photos'));
    }

    public function updateApproval($image_id, $status)
    {
        if ($image_id != null && $status !=null){
            $photo = Photo::find($image_id);
            if ($photo != null){
                $photo ->update([
                   'status'=> $status,
                    'approve_by'=>$status == 'approved' ? Auth::guard('admin')->id() : null,
                    'approve_date' => $status == 'approved'? date('Y-m-d H:i:s') : null,
                ]);
                return redirect()->back();
            }else{
                return'invalid data';
            }
        }return 'invalid date';
    }
    public function showBuyout()
    {
        $photos = Photo::with('user')->where('status','selling')->get();
        return view('admin.buyout',compact('photos'));
    }
    public function updateBuyout()
    {
        $this->validate(request(),[
           'photo_id'=>'required',
            'user_id'=>'required',
            'selling-status'=>'required',
            'price'=>'required'
        ]);
        Photo::findOrFail(request('photo_id'))->update([
           'buyout_by'=>request('selling-status') != 'not-selling' ? Auth::guard('admin')->id():null,
           'buyout_date'=>request('selling-status') != 'not-selling' ? now() :null,
            'rate'=>request('selling-status') != 'not-selling' ? request('price') : null,
            'status'=>request('selling-status')
        ]);

        $userData = User::find(request('user_id'));
        $preAmount = $userData->financial->balance;
        $newAmount = $preAmount + request('price');
        $userData->financial()->update([
            'balance'=> $newAmount
        ]);
        return redirect()->back();
    }

    public function paymentCheck()
    {
        $cashOut= CashOut::with('user')
                            ->where('status','pending')->get();
        return view('admin.payment',compact('cashOut'));
    }

    public function paymentCashout($cashoutID,$status)
    {
        $cashOutProcess = CashOut::findOrFail($cashoutID);
        $cashOutProcess->update([
            'status' => $status
        ]);
        return redirect()->back();
    }
}
