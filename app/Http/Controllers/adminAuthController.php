<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class adminAuthController extends Controller
{
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    /**
     * @throws ValidationException
     */
    public function adminLogin()
    {
        $this->validate(request(),[
            'username'=>'required',
            'password'=>'required'
        ]);
        if (Auth::guard('admin')->attempt([
            'username'=>request('username'),
            'password'=>request('password')
        ])){
            return redirect()->route('admin.dashboard.show');
        }else{
            return 'wrong credential';
        }
    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('show.admin.login');
    }
}
