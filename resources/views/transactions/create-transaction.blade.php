@extends('layouts.common')
@section('header')
    Create new trancsaction
@endsection

@section('content')
    <div class="row">
        <div class="card card-primary">

            <form method="post" action="{{route('transactions.store')}}">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label>Date and time:</label>
                        <input type="datetime-local" name="transaction_datetime">
                    </div>


                    <div class="form-group">
                        <label>Wallet name:</label>
                        <select class="form-control" name="wallet_id">
                            <option>Select wallet</option>

                            @foreach($wallets as $wallet)
                                <option value="{{$wallet->id}}" @if(old('wallet_id') == $wallet->id) selected @endif >{{$wallet->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Transaction type:</label>
                        <select class="form-control" name="type">
                            <option>Select type</option>
                            @foreach($types as $key => $value)
                                <option value="{{$key}}"
                                        @if(old('type') == $key) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="summ">Summ:</label>
                        <input type="text" name="summ" class="form-control" placeholder="Enter summ" value="{{ old('summ') }}">
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <input type="text" name="comment" class="form-control" id="balance"
                               placeholder="Enter comment">
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
