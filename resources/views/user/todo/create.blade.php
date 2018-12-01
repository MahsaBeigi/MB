@extends('user.layouts.master')
@section('content')
    <!-- Row -->
    <div class="row">

        <!-- Column -->
        <div class="col-lg-10 col-xlg-11 col-md-9">
            <div class="card">
                <!-- Tab panes -->
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger text-right">
                            <div class="oaerror danger w-100">
                                <ul class="m-0 p-0 list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li><strong>خطا</strong> - {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <form class="form-horizontal form-material" action="{{$options['action']}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        {{method_field($options['method'])}}
                        <div class="form-group">
                            <label class="col-md-12">عنوان</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$options['fields']->title or old('title')}}" placeholder="عنوان را وارد کنید"
                                       class="form-control form-control-line" name="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">توضیحات </label>
                            <div class="col-md-12">
                                <textarea class="form-control form-control-line" name="description"
                                          placeholder="توضیحات محصول را وارد کنید ">{{old('description',optional($options['fields'])->description)}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection
