<?php

namespace App\Http\Controllers;

use App\Mail\resetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class registerController extends Controller
{
    public function showRegister()
    {
        return view('user.register');
    }
    public function register()
    {
        $this->validate(request(),[
            'name'=>'required|min:4|alpha_dash|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:8|alpha_dash|confirmed'
            ]);

        $user = User::create([
            'name'=>request('name'),
            'email' => request('email'),
            'password'=>bcrypt(request('password'))
        ]);
        $user->financial()->create([
           'balance'=> 0.00
        ]);
        return 'ok';
    }
//Login--------
    public function showLogin()
    {
        return view('user.login');
    }
    public function login()
    {
        $this->validate(request(),[
            'name'=>'required',
            'password' => 'required'
        ]);
        if (Auth::attempt([
            'name'=>request('name'),
            'password' => request('password')
            ])){
            return redirect('/udashboard');
        }else{
            return 'credential not match!';
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    //Forget Password

    public function showForgetPassword()
    {
        return view('/forget-password');
    }
    public function forgetPassword()
    {
        $this->validate(\request(),[
           'email'=>'required|email'
        ]);
        $userExist= User::where('email',\request('email'));
        if ($userExist->count() ==1){
            $data = [];
            $userExist= $userExist->first();
            $generateToken = sha1(md5(rand()));
            $chkForgetEntry= PasswordReset::where('email',\request('email'));
            if ($chkForgetEntry->count()>0){
                $chkForgetEntry->update([
                    'token'=>$generateToken
                ]);
            }else{
                PasswordReset::create([
                   'user_id'=>$userExist->id,
                   'email'=>$userExist->email,
                   'token'=>$generateToken
                ]);
            }
            $data['email']= $userExist->email;
            $data['token']=$generateToken;
            Mail::to($userExist->email)->send(new resetPassword($data));
            return 'found';
        }else{
            return 'email not found';
        }
    }
    //Password Reset send Email
    public function showPasswordReset($email,$token)
    {
        $check= PasswordReset::where('email',$email)->where('token',$token);

        if ($check->count()==1){
            $user_id= $check->first()->user_id;
            return view('passwordReset',compact('user_id'));
        }else{
            return 'Unauthorized';
        }
    }
    public function passwordReset()
    {
        $user_id = request('user_id');
        User::find($user_id)->update([
            'password' => bcrypt(request('password'))
        ]);
        PasswordReset::where('user_id',$user_id)->delete();
        return 'success';
    }

}
