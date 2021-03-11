@extends('layouts.common')
@section('header')
    Edit wallet {{$wallet->name}}
@endsection

@section('content')
    <div class="row">
        <div class="card card-primary">

            <form method="post" action="{{route('wallets.update', [$wallet->id])}}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">New wallet name:</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$wallet->name}}">
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
