<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// TODO перенести валидации в реквесты

class UserController extends Controller
{
    public function create()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), //   вместо фассада Hash можно использовать хелпер bcrypt($request->password)

        ]);
        // session()->flash('success', 'Successful registration. Last step, you need check base currency.');
        Auth::login($user);

        return redirect()->route('settings')->with('success', 'Successful registration. Last step, you need check base currency.');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Incorrect login or password...');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('public.home');
    }
    public function changePasswordForm()
    {
        return view('user.change-password');
    }

    public function storeNewPassword(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }
        $request->validate([
            'new_password' => 'required|confirmed',
        ]);
        $request->session()->passwordConfirmed();
        $user->password = Hash::make($request->new_password);
        $user->update();
        return redirect()->route('dashboard');
    }
}
