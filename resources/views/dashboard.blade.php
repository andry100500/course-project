@extends('layouts.common')
@section('header')
    Financial management
@endsection

@section('content')

    <h2 class="mb-3">User Data</h2>
    <div class="row mb-5">
        <div class="col"><small class="text-muted">Name: </small> <b>{{$user->name}}</b></div>
        <div class="col"><small class="text-muted">Email: </small> <b>{{$user->email}}</b></div>
        <div class="col"><small class="text-muted">Balance: </small> <b>{{round($userBalance, 2)}} {{$baseCurrencyCode}}</b></div>
    </div>
    <div class="row justify-content-center">
        <a href="{{route('settings')}}">Edit user data</a>
    </div>

    <hr>

    <h2 class="mb-3">Wallets</h2>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

        @foreach($wallets as $wallet)

            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 fw-normal">{{$wallet->name}}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted">Balance: </small> $0</h1>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <a href="{{route('settings')}}">Manage Wallets</a>
    </div>
@endsection
