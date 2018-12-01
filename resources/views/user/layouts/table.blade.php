<table class="table table-sm" style="direction: rtl;width: 60%;margin:0px auto;">

    <thead class="text-center">
        <tr>
            @foreach($header as $th)
                <th class="text-center">{{$th}}</th>
            @endforeach
        </tr>
    </thead>

    <tbody class="text-center">
        @foreach($data as $tr)
            <tr>

                @foreach($tr as $td)
                    @isset($td['text'])
                        <td class="@php echo isset($td['class']) ? $td['class'] : ''; @endphp">{!! $td['text'] !!}</td>
                    @endisset
                @endforeach
                @isset($td['pivot'])
                    <td class="text-left">
                        @foreach($td['pivot'] as $pivot)
                            @if($pivot['button'])
                                <form action="{{$pivot['action']}}" method="POST">
                                    <input type="hidden" name="id" value="{{$pivot['id']}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-sm {{$pivot['btnClass']}}">
                                        <i class="{{$pivot['icon']}}"></i>&nbsp; {{$pivot['text']}}
                                    </button>
                                </form>

                            @else
                                <a href="{{$pivot['url']}}">
                                    <button type="button" class="btn btn-sm {{$pivot['btnClass']}}">
                                        <i class="{{$pivot['icon']}}"></i>&nbsp; {{$pivot['text']}}
                                    </button>
                                </a>
                            @endif
                        @endforeach

                    </td>
                @endisset
            </tr>
        @endforeach
        @if(empty($data))
            <tr>
                <td colspan="100" class="alert alert-info">اطلاعاتی برای نمایش وجود ندارد.</td>
            </tr>
        @endif
    </tbody>
</table>


