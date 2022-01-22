<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $rules = [
            'email'         => 'required|email',
            'password'      => 'required'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login_form')->withErrors([
                'auth'   => 'Email atau Password Salah'
            ]);
        }
    }

    public function showLoginForm()
    {
        if (Auth::check()){
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login_form');
    }
}
