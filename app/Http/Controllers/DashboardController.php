<?php

namespace App\Http\Controllers;


use App\Facades\Course;
use App\Facades\Money;
use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
    {
        Course::getCourse('USD');

        $user = Auth::user();
        $wallets = Wallets::where('user_id', $user->id)->get();
        $userBalance = Money::overallUserBalance();
        $baseCurrencyCode = Money::baseCurrencyCode();

        return view('dashboard', compact('user', 'wallets', 'userBalance', 'baseCurrencyCode'));
    }

}
