<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('form.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('/admin/transaksi');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        auth('admin')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
