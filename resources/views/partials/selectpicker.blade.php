<?php
if (preg_match('/^(.+?)\[(.+?)\]$/i', $name)) {
    $flat_name = preg_replace('/^(.+?)\[(.+?)\]$/i', '$1.$2', $name);
} else {
    $flat_name = $name;
}
?>

<div class="form-group {{ $errors->has(@$flat_name)? 'has-error':'' }} {{ isset($wrapperClass)? $wrapperClass:'' }}">
    <label for="{{ @$name }}" class="control-label">{{ @$label }}</label>
    <select name="{{ @$name }}" id="{{ @$name }}" class="form-control select2" {!! $extras or '' !!}>
        @if(isset($placeholder))
        <option value="" disabled="disabled" selected="selected">{{ @$placeholder }}</option>
        @endif

        @foreach($options as $key => $value)
            @if (@$useKeys)
                <option value="{{ $key }}"  {{ isset($useOld)? old($flat_name, $useOld) == $key? 'selected':'':'' }}>{{ $value }}</option>
            @else
                <option value="{{ $value }}" {{ isset($useOld)? old($flat_name, $useOld) == $value? 'selected':'':'' }}>{{ $value }}</option>
            @endif
        @endforeach
    </select>

    @if($errors->has(@$flat_name))
        <span class="help-block">{{ $errors->first(@$flat_name) }}</span>
    @endif
</div>
