<?php

namespace App\Services;

use App\Facades\Course;
use App\Facades\Money;
use App\Models\Currencies;
use App\Models\Transaction;
use App\Models\Wallets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MoneyManager
{
    private $user;
    private $wallets;
    private $currencies;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->wallets = $this->rebuildArray(Wallets::query()->where('user_id', $this->user->id)->get());
        $this->currencies = $this->rebuildArray(Currencies::get());

    }

    public function rebuildArray($array)
    {
        $newArray = [];
        foreach ($array as $item) {
            $newArray[$item['id']] = $item;
        }
        return $newArray;
    }

    /**
     * Method return users balance from all wallets in base currency
     */
    public function overallUserBalance()
    {
        $balance = 0;

        foreach ($this->wallets as $wallet) {
            $walletBalance = $this->inBaseCurrency($wallet->id, $wallet->balance);
            $balance += $walletBalance;
        }

        return $balance;
    }

    /**
     *  The method increases the user's balance
     */
    public function plus($wallet_id, $summ)
    {
        $wallet = Wallets::find($wallet_id);
        $wallet->balance += $summ;

        $wallet->update();
    }


    /**
     * Method The method reduces the user's balance
     */
    public function minus($wallet_id, $summ)
    {
        $wallet = Wallets::find($wallet_id);
        $wallet->balance -= $summ;

        $wallet->update();
    }


    /**
     * The method returns the balance or summ in base currency
     */
    public function inBaseCurrency($wallet_id, $summ)
    {


        $baseCurrencyCode = $this->baseCurrencyCode();
        $baseCurrencyCource = Course::getCourse($baseCurrencyCode);
        $walletCurrencyId = $this->wallets[$wallet_id]->currency_id;
        $walletCurrencyCode = $this->currencies[$walletCurrencyId]->code;
        $walletCurrencyCource = Course::getCourse($walletCurrencyCode);

        $newSumm = $summ * $walletCurrencyCource;

        $rezultSumm = $newSumm / $baseCurrencyCource;
        return $rezultSumm;
    }

    public function baseCurrencyCode()
    {
        $baseCurrencyId = $this->user->currency_id;
        $baseCurrencyCode = $this->currencies[$baseCurrencyId]->code;
        return $baseCurrencyCode;
    }

    /**
     * This method update wallets balance, when user changing transaction
     */
    public function updateBalances($wallet_id, $type, $summ)
    {
        if ($type === '+') {
            $this->plus($wallet_id, $summ);
        } elseif ($type === '-') {
            $this->minus($wallet_id, $summ);
        }
    }

    /**
     * Cancel the change in the balance of the wallet according to the previous variant of the transaction
     */
    public function canselBalanceChange($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        if ($transaction->type === '+') {
            $this->minus($transaction->wallet_id, $transaction->summ);
        } elseif ($transaction->type === '-') {
            $this->plus($transaction->wallet_id, $transaction->summ);
        }

    }


}
