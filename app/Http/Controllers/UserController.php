<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function create()
    {
        return view('user.register');
    }

    public function store(UserStoreRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), //   вместо фассада Hash можно использовать хелпер bcrypt($request->password)

        ]);

        Auth::login($user);

        return redirect()->route('settings')->with('success', 'Successful registration. Last step, you need check base currency.');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(UserLoginRequest $request)
    {

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

    public function storeNewPassword(StoreNewPasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Вы указали не правильный пароль.');
        }

        $request->session()->passwordConfirmed();
        $user->password = Hash::make($request->new_password);
        $user->update();
        return redirect()->route('settings')->with('success', 'Вы изменили пароль.');
    }
}
