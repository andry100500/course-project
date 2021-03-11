<?php

namespace App\Http\Controllers;

use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Facades\Money;

class DashboardController extends Controller
{
    public function index(Money $money)
    {



       $money = Money2::hello();

      dd($money->hello());





        $user = Auth::user();
        $wallets = Wallets::where('user_id', $user->id)->get();

        return view('dashboard', compact('user', 'wallets'));
    }

}
