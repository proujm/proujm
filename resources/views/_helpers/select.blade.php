{{--выпадающий список--}}
<select
        @foreach($attrs as $key => $value)
        {!! $key."='$value'" !!}
        @endforeach

        @if($isDisabled == 1)
        disabled
        @endif
>
    @if($first_option)
        <option value = "">{{$first_option}}</option>
    @endif

    @foreach($options as $option)
        @if($selected == $option["$selected_name"])
            <option value="{{$option["$selected_name"]}}" selected> {{$option["$option_name"]}}</option>
        @else
            <option value="{{$option["$selected_name"]}}">{{$option["$option_name"]}}</option>
        @endif
    @endforeach
</select>