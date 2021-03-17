@extends('layouts.common')
@section('header')
    Settings
@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="basic" data-toggle="pill" href="#v-pills-home" role="tab"
                   aria-controls="v-pills-home" aria-selected="true">Basic data</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                   aria-controls="v-pills-profile" aria-selected="false">Wallets</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                   aria-controls="v-pills-messages" aria-selected="false">Change password</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="basic">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    <div class="card card-primary">

                        <form method="post" action="{{route('settings.update_base')}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Email (login):</label>
                                    <input type="text" class="form-control" id="email" disabled=""
                                           value=" {{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Enter yuor name"
                                           value="{{$user->name}}">
                                </div>

                                <div class="form-group">
                                    <label>Base currency:</label>
                                    <select class="form-control" name="currency_id">

                                        @if(!$user->currency_id)
                                            <option>Select currency</option>
                                        @endif

                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->id}}"
                                                    @if($currency->id == $user->currency_id)
                                                    selected
                                                @endif>{{$currency->name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                    <table class="table">
                        <thead>
                        <tr class="table-light">
                            <th scope="col">Name</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($wallets as $wallet)
                            <tr class="table-light">
                                <td>{{$wallet->name}}</td>
                                <td>{{$wallet->currency->name}}</td>
                                <td>{{$wallet->balance}}</td>
                                <td class="d-flex">
                                    <a class="btn btn-primary mr-2" href="{{route('wallets.edit', [$wallet->id])}}">Rename </a>

                                    <form action="{{route('wallets.destroy', [$wallet->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    <div>
                        <a class="btn btn-primary" href="{{route('wallets.create')}}">Create new wallet</a>
                    </div>
                </div>


                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="card card-primary">
                        <form action="{{route('change.password')}}" method="post">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="password">Old password:</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password">New password:</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation">New password confirm:</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                           name="new_password_confirmation">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Change</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">


    </div>
@endsection
