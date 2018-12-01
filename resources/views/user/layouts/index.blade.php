@extends('user.layouts.master')
@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="card text-right">
                    <div class="card-header">
                        <strong>{{optional($options)['title']}}</strong>
                        @foreach($options['buttons'] as $button)
                            <b-button size="{{optional($button)['size'] ?? ''}}"
                                      @php if(optional($button)['click']) echo '@click=\'' .optional($button)['click'] .'\'' @endphp
                                      @php if(optional($button)['to']) echo 'to=\'' .optional($button)['to'] .'\'' @endphp
                                      class="col-12 col-sm-auto float-left mt-0 mr-1 mb-1"
                                      variant="{{optional($button)['variant'] ?? 'primary'}}">
                                <i class="{{optional($button)['icon'] ?? ''}}"></i>&nbsp;{{optional($button)['text']}}</b-button>
                        @endforeach
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                            <p class="alert alert-{{session('type')}}">{!!session('message')  !!}</p>
                        @endif
                        @component('user.layouts.table',['header'=>$header,'data'=>$rows, 'index'=> true,'options' => $options])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection