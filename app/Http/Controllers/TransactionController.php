<?php

namespace App\Http\Controllers;

use App\Facades\Course;
use App\Facades\Money;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    const TYPES = [
        '+' => 'Income',
        '-' => 'Spending'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $transactions = Transaction::with('wallet')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(2); // здесь 2 элемента на странице просто для простоты тестирования

        $userBalance = Money::overallUserBalance();
        $baseCurrencyCode = Money::baseCurrencyCode();

        return view('transactions.transactions-index', compact('transactions', 'userBalance', 'baseCurrencyCode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wallets = Wallets::all();
        $types = self::TYPES;
        return view('transactions.create-transaction', compact('wallets', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(TransactionStoreRequest $request)
    {
        $transaction = new Transaction();

        $transaction->user_id = Auth::user()->id;
        $transaction->wallet_id = $request->wallet_id;
        $transaction->type = $request->type;
        $transaction->summ = $request->summ;
        $transaction->comment = $request->comment;
        $transaction->transaction_datetime = $request->transaction_datetime;


        // TODO - это нужно обернуть в транзацкцию
        // началоло транзакции

        if ($transaction->type === '+') {
            Money::plus($transaction->wallet_id, $transaction->summ);
        } elseif ($transaction->type === '-') {
            Money::minus($transaction->wallet_id, $transaction->summ);
        }

        $transaction->save();
        // конец транзакции

        return redirect()->route('transactions.index')->with('success', 'Transaction added');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $wallets = Wallets::all();
        $types = self::TYPES;
        return view('transactions.edit-transaction', compact('transaction', 'wallets', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */


    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->wallet_id = $request->wallet_id;
        $transaction->type = $request->type;
        $transaction->summ = $request->summ;
        $transaction->comment = $request->comment;
        $transaction->transaction_datetime = $request->transaction_datetime;


        // TODO - обернуть в транзакцию
        // начало транзакции

        Money::canselBalanceChange($transaction->id);
        Money::updateBalances($transaction->wallet_id, $transaction->type, $transaction->summ);

        $transaction->update();
        // конец транзакции

        return redirect()->route('transactions.index')->with('success', 'Transaction changed');
    }


    // TODO - обернуть в транзакцию
    public function destroy($id)
    {
        // начало транзакции
        DB::transaction(function ($id) {
            $transaction = Transaction::find($id);
            Money::canselBalanceChange($id);
            $transaction->delete();
        }, 3);
        // конец транзакци
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted');
    }
}
