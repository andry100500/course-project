@extends('layouts.common')
@section('header')
    Create new wallet
@endsection

@section('content')
    <div class="row">
        <div class="card card-primary">

            <form method="post" action="{{route('wallets.store')}}">
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Wallet name:</label>
                        <input type="text" name="name" class="form-control" id="name"
                               placeholder="Enter wallet name">
                    </div>

                    <div class="form-group">
                        <label>Currency:</label>
                        <select class="form-control" name="currency_id">
                            <option>Select currency</option>
                            @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="balance">Start balance:</label>
                        <input type="text" name="balance" class="form-control" id="balance"
                               placeholder="Enter start balance">
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
