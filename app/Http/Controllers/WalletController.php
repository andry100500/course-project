<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Http\Requests\WalletUpdateRequest;
use App\Models\Currencies;
use App\Models\Transaction;
use App\Models\Wallets;
use Illuminate\Http\Request;

class WalletController extends Controller
{


    public function create()
    {
        $currencies = Currencies::all();

        return view('wallets.create-wallet', compact('currencies'));
    }


    // TODO - решить, что делать с транзакциями при указании баланса - или убрать добавление баланса или реализовать транзакции
    // если удалять, то в шаблоне криейт, в миграции и в БД

    public function store(WalletStoreRequest $request)
    {
        $wallet = new Wallets();
        $wallet->name = $request->name;
        $wallet->user_id = $request->user()->id;
        $wallet->currency_id = $request->currency_id;

        $wallet->save();
        return redirect()->route('settings')->with('success', 'Wallet is added');
    }

    public function edit($id)
    {
        $wallet = Wallets::find($id);
        $currencies = Currencies::all();

        return view('wallets.edit-wallet', compact('wallet', 'currencies'));
    }


    public function update(WalletUpdateRequest $request, $id)
    {
        $wallet = Wallets::find($id);
        $wallet->name = $request->name;

        $wallet->save();
        return redirect()->route('settings')->with('success', 'Wallet name updated');

    }

    public function destroy($id)
    {
        $walletTransactionCount = Transaction::query()->where('wallet_id', $id)->count();

        if ($walletTransactionCount > 0){
            return redirect()->route('settings')->withErrors(["You Can't delete wallet with transactions"]);
        }

        $wallet = Wallets::find($id);
        $wallet->delete();
        return redirect()->route('settings')->with('success', 'Wallet was deleted');
    }
}
