<table class="table table-striped {{$tableClass ?? 'c-table-blue table-borderless table-sm'}}" style="direction: rtl">
    <thead class="text-center">
        <tr>
            @if(isset($index) && $index)
                <th class="text-center">#</th>
            @endif
            @foreach($header as $th)
                <th class="text-center">{{$th}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($data as $tr)
            <tr>
                @php $_rowIteration = $loop->iteration @endphp
                @if(isset($index) && $index)
                    @if(isset($options['pagination']) && isset($options['pagination']['offset']))
                        <td>@{{ @php echo $options['pagination']['offset'] + $_rowIteration @endphp | toPersianNumber }}</td>
                    @else
                        <td>@{{ @php echo $_rowIteration @endphp | toPersianNumber }}</td>
                    @endif
                @endif
                @foreach($tr as $td)
                    @isset($td['text'])
                        <td class="@php echo isset($td['class']) ? $td['class'] : ''; @endphp">
                            @if(isset($td['tag']) && $td['tag'])
                                {!! $td['text'] !!}
                            @else
                                <span id="data-{{$_rowIteration}}-{{$loop->iteration}}"> @{{ '@php echo $td['text'] @endphp' | toPersianNumber(false)}}</span>
                            @endif
                            @isset($td['tooltip'])
                                <b-tooltip target="data-{{$_rowIteration}}-{{$loop->iteration}}" placement="bottom" title="{{$td['tooltip']}}"></b-tooltip>
                            @endisset
                        </td>
                    @endisset
                @endforeach
                @isset($td['actions'])
                    <td class="text-left">
                        @if(count($td['actions']) <= 2)
                            @foreach($td['actions'] as $action)
                                @if($action['button'])
                                    <b-button type="button" class="btn btn-sm {{$action['btnClass']}}" @click="{{$action['@click']}}">
                                        <i class="{{$action['icon']}}"></i>&nbsp; {{$action['text']}}
                                    </b-button>
                                @else
                                    <a href="{{$action['url']}}">
                                        <b-button type="button" class="btn btn-sm {{$action['btnClass']}}">
                                            <i class="{{$action['icon']}}"></i>&nbsp; {{$action['text']}}
                                        </b-button>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <b-dropdown text="" variant="primary">
                                @foreach($td['actions'] as $action)
                                    @if($action['button'])
                                        <b-dropdown-item-button class="btn btn-sm {{$action['btnClass']}}" @click="{{$action['@click']}}">
                                            <i class="{{$action['icon']}}"></i>&nbsp; {{$action['text']}}
                                        </b-dropdown-item-button>
                                    @else
                                        <b-dropdown-item href="{{$action['url']}}" class="btn btn-sm {{$action['btnClass']}}">
                                            <i class="{{$action['icon']}}"></i>&nbsp; {{$action['text']}}
                                        </b-dropdown-item>
                                    @endif
                                @endforeach
                            </b-dropdown>
                        @endif
                    </td>
                @endisset
            </tr>
        @endforeach
        @if((isset($data['filters']) && (count($data) < 2)) || empty($data) )
            <tr>
                <td colspan="100" class="alert alert-info">اطلاعاتی یافت نشد.</td>
            </tr>
        @endif
    </tbody>
</table>
@if(isset($options['pagination']) && $options['pagination']['pages'] > 1)
    <b-pagination-nav size="{{optional($options['pagination'])['size'] ?? 'md'}}" base-url="{{$options['pagination']['path']}}"
                      :value="{{$options['pagination']['current'] ?? 1}}"
                      align="{{$options['pagination']['align'] ?? 'center'}}"
                      :number-of-pages="{{$options['pagination']['pages']}}" :page-gen="(page) => {return toPersianNumber(page)}">
    </b-pagination-nav>
@endif