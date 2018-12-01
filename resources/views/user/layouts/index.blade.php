@extends('user.layouts.master')
@section('content')
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-12">
                <div class="card text-right">
                    <div class="card-header">
                        <strong class="text-right">{{$options['title']}}</strong>
                        @foreach($options['buttons'] as $button)
                            <a href="{{($button)['to'] ?? ''}}">
                                <button size="{{($button)['size'] ?? ''}}"
                                        class="float-left mt-0 mr-1 dir btn btn-primary">
                                    <i class="{{($button)['icon'] ?? ''}}"></i>&nbsp;{{($button)['text']}}</button>
                            </a>
                        @endforeach
                    </div>
                    <div class="card-body">
                        @component('user.layouts.table',['header'=>$header,'data'=>$rows])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection