@extends('user.layouts.master')
@section('content')
    <section class="main">
        <div class="row">

            <div class="col-xs-12 col-centered col-xs">
                <div class="box box-solid">
                    <div class="box-header">

                        <h3 class="box-title">اطلاعات کاربری </h3>
                    </div>
                    <b-form method="post" action="/user/details" role="form" novalidate="novalidate" id="setting">
                        {{csrf_field()}}
                        {{method_field($response['method'])}}
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
                        <div class="box-body clearfix">

                            <div class="col-xs-12 clearfix">

                                <hr/>
                            </div>

                            <div class="clearfix"></div>
                            <div role="group" class="form-row b-form-group form-group">
                                {{--<div class="form-group col-sm-4 col-md-4 col-xs-12 clearfix" >--}}
                                <label>نام و نام خانوادگی </label>
                                <b-input type='text' id="t_name" name="first_name" class="form-control" placeholder="نام"
                                         value="{{$response['user']->first_name}}"></b-input>
                                <b-input type='text' name="last_name" class="form-control" placeholder="نام خانوادگی"
                                         value="{{$response['user']->last_name}}"></b-input>
                            </div>
                            <div role="group" class="form-row b-form-group form-group">
                                <label>کد ملی</label>
                                <b-input readonly="readonly" type='text' id="t_code" name="meli_code" class="form-control ltr number"
                                         placeholder="کد ملی خود را وارد کنید"
                                         value="{{$response['user']->meli_code}}"></b-input>
                            </div>
                            <div role="group" class="form-row b-form-group form-group">
                                <label> شهر </label>
                                <b-input type='text' id="t_email" name="city" class="form-control ltr" value="{{$response['user']->city}}"></b-input>
                            </div>
                            <div role="group" class="form-row b-form-group form-group">
                                <label> آدرس </label>
                                <b-textarea type='text' id="t_dad" name="address" class="form-control ltr number"
                                >{{$response['user']->address }}</b-textarea>
                            </div>

                            <div role="group" class="form-row b-form-group form-group">
                                <label>شماره همراه <i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-container="body"
                                                      data-placement="top" data-title="شماره همراه "
                                                      data-content=" "></i></label>
                                <b-input type='text' id="t_mobile" placeholder="مثال:0912345678" name="mobile" class="form-control ltr number"
                                         value="{{$response['user']->mobile}}"></b-input>

                            </div>

                        </div>
                        <div class="box-footer clearfix">
                            <b-button class="btn btn-primary accept pull-left" type="submit">ویرایش اطلاعات</b-button>
                        </div>

                    </b-form>

                </div>
            </div>
        </div>
    </section>


@endsection