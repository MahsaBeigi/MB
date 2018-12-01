@extends('user.layout.auth')
@section('header')
    <style>
        #app {

            background-image: url("../images/s.jpg");
            background-attachment: fixed;
            background-position: center;
            border: 2px solid black;
        }
    </style>
@endsection
@section('content')

    <div class="navbar-collapse collapse move-me">
        <ul class="nav navbar-nav navbar-right" style="font-size:16px;">
            <a href="/" style="font-size:20px;direction: rtl;">خانه</a><i class="fa fa-home"></i></li>

        </ul>
    </div>
    <div class="app flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">

                    <div class="card-group mb-0">
                        <div class="card p-4">
                            <div class="card-body">
                                <form action="/user/login" method="POST">
                                    {{csrf_field()}}
                                    <h1 class="text-center"> ورود </h1>

                                    {{--errors--}}
                                    @if ($errors->any())
                                        <div class="error-notice text-right">
                                            <div class="oaerror danger w-100">
                                                <ul class="m-0 p-0 list-unstyled">
                                                    @foreach ($errors->all() as $error)
                                                        <li><strong>خطا</strong> - {{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="error-notice text-right">
                                            <div class="oaerror danger w-100">
                                                <strong>خطا</strong> - {{ session('error') }}
                                            </div>
                                        </div>
                                    @endif
                                    {{--end errors--}}

                                    <div class="input-group mb-3">
                                        <span class="input-group-addon" style="border: 1px solid #0003;"><i
                                                    class="icon-user p-3"></i></span>
                                        <input type="text" name="username" class="form-control text-right iransans"
                                               placeholder="نام کاربری(ایمیل)" autofocus>
                                    </div>
                                    <div class="input-group mb-4">
                                        <span class="input-group-addon" style="border: 1px solid #0003;"><i
                                                    class="icon-lock p-3"></i></span>
                                        <input type="password" name="password" class="form-control text-right iransans"
                                               placeholder="پسورد ">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">

                                            <a href="/user/register" class="btn btn-secondary px-4 iransans">
                                                ثبت نام <i class="fa fa-home" style="color:black;"></i>
                                            </a>
                                            <button type="submit" class="btn btn-primary px-4 iransans">ورود</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
