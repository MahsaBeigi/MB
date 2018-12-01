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
                                <label>نام </label>
                                <b-input type='text' id="t_name" name="name" class="form-control" placeholder="نام"
                                         value="{{$response['user']->name}}"></b-input>

                            </div>
                            <div role="group" class="form-row b-form-group form-group">
                                <label>ایمیل</label>
                                <b-input readonly="readonly" type='text' id="t_code" name="meli_code" class="form-control ltr number"
                                         placeholder="ایمیل"
                                         value="{{$response['user']->mail}}"></b-input>
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