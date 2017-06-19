<?php
    $flat_name = '';
    if(isset($name))
    {
        if (preg_match('/^(.+?)\[(.+?)\]$/i', $name)) {
            $flat_name = preg_replace('/^(.+?)\[(.+?)\]$/i', '$1.$2', $name);
        } else {
            $flat_name = $name;
        }
    }
?>

<div class="form-group {{ $errors->has(@$flat_name)? 'has-error':'' }} {{ isset($wrapperClass)? $wrapperClass:'' }}">
    <label for="{{ @$name }}" class="control-label">{{ @$label }}</label>
    <input type="text" class="form-control {{ isset($autocomplete)? 'autocomplete':'' }}" name="{{ @$name }}" id="{{ @$name }}" placeholder="{{ @$placeholder }}"
           value="{{ isset($useOld)? old($flat_name, $useOld):'' }}"
            {{ isset($pattern)? 'pattern='.$pattern.'':'' }} {{ @$status }}
            {!! @$extras !!}>

    @if($errors->has(@$flat_name))
        <span class="help-block">{{ $errors->first(@$flat_name) }}</span>
    @endif
</div>

@if (isset($autocomplete))
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $("#{{ $name }}").data('array', {!! json_encode($autocomplete) !!});
        });
    </script>
@endsection
@endif