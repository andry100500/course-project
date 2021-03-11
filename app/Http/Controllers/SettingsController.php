<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBaseRequest;
use App\Models\Currencies;
use App\Models\User;
use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $currencies = Currencies::all();
        $wallets = Wallets::where('user_id', $user->id)->with('currency')->get();

        return view('settings', compact('user', 'currencies', 'wallets'));
    }

    public function updateBaseData(UpdateBaseRequest $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->currency_id = $request->currency_id;

        $user->save();

        return redirect()->route('settings')->with('success', 'Base data updated');
    }


}
