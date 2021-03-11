<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // TODO - вывести баланс

    public function index()
    {

        $transactions = Transaction::with('wallet')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(2); // здесь 2 элемента на странице просто для простоты тестирования




        return view('transactions.transactions-index', compact('transactions'));
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

        $transaction->save();

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


    // TODO - пересчет баланса

    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $transaction->wallet_id = $request->wallet_id;
        $transaction->type = $request->type;
        $transaction->summ = $request->summ;
        $transaction->comment = $request->comment;
        $transaction->transaction_datetime = $request->transaction_datetime;

        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */

    // TODO - пересчет баланса
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted');
    }
}
