<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class LoginController extends Controller
{
    public function login() {
        return view('dashboard.auth.login');
    }


    public function authenticate(AdminLoginRequest  $request) {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect() -> route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => __('admin\redirect.invalid-data')]);
    }


    public function logout() {
        $guard = auth('admin');
        $guard->logout();
        return redirect()->route('admin.login');
    }

}


