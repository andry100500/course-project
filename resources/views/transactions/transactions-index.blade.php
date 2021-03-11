@extends('layouts.common')
@section('header')
    Transactions
@endsection

@section('content')
    <div class="col-12">
        <a href="{{route('transactions.create')}}" class="btn btn-primary">New transaction</a>
    </div>
    <div class="row">

        <div class="col-12">

            <table class="table">
                <thead>
                <tr class="table-light">
                    <th scope="col">Date</th>
                    <th scope="col">Wallet</th>
                    <th scope="col">Summ</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Actions</th>

                </tr>
                </thead>
                <tbody>


                @foreach($transactions as $transaction)
                    <tr class="table-light">
                        <td>{{$transaction->transaction_datetime}}</td>
                        <td>{{$transaction->wallet->name}}</td>
                        <td>
                            @if($transaction->type === '-')
                                -
                            @endif
                            {{$transaction->summ}}</td>
                        <td>{{$transaction->comment}}</td>
                        <td>
                            <a href="{{route('transactions.edit',[$transaction->id])}}">Edit </a>

                            <form action="{{route('transactions.destroy',[$transaction->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>

            {{ $transactions->onEachSide(2)->links() }}
        </div>
@endsection
