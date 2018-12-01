@extends('user.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
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
                    @if(Session::has('alert'))

                        {{ Session::get('alert') }} @php Session::forget('alert'); @endphp

                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">نام</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">شماره همراه</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" v-model=phone class="form-control" name="phone" value="{{ old('phone') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row m-4">
                                <div class="col-12 text-center">

                                    <button type="button" class="btn btn-success"
                                            @click="registerPhone(phone)">ارسال کد
                                    </button>

                                </div>
                            </div>
                            <hr>
                            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                <span class="input-group-addon red">*</span>
                                <div class="col-md-6">
                                    <input type="text" name="code" class="form-control text-right iransans" placeholder="کد را وارد کنید">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">ایمیل</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">رمز عبور</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">تکرار رمز عبور</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        ثبت نام
                                    </button>
                                    <a href="/user/login" class="btn btn-secondary px-4 iransans">
                                        ورود <i class="fa fa-com-in" style="color:black;"></i>
                                    </a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
