{{--<form action="{{route('login')}}" method="post">--}}
{{--    @csrf--}}
{{--    Email:<input type="text" name="email" value="{{old('email')}}">--}}
{{--    Password:<input type="text" name="password">--}}
{{--    <button type="submit">Login</button>--}}
{{--</form>--}}




@extends('public.common-public')
@section('header')
    Registration
@endsection

@section('content')
    <div class="register-page" style="min-height: 542px;">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="./" class="h1"><b>Admin</b>LTE</a>
                </div>
                <div class="card-body">



                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>


                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->


    </div>
@endsection
