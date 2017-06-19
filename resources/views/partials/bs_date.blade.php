<?php
    if (preg_match('/^(.+?)\[(.+?)\]$/i', $name)) {
        $flat_name = preg_replace('/^(.+?)\[(.+?)\]$/i', '$1.$2', $name);
    } else {
        $flat_name = $name;
    }
?>

<div class="form-group {{ $errors->has(@$flat_name)? 'has-error':'' }}">
    <label for="{{ @$name }}" class="control-label">{{ @$label }}</label>
    <input type="date" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="{{ @$name }}" id="{{ @$name }}" data-provide="datepicker"
           placeholder="{{ @$placeholder }}"
           value="{{ isset($useOld)? old($flat_name, $useOld):'' }}" {!! @$extras !!}>

    @if($errors->has(@$flat_name))
        <span class="help-block">{{ $errors->first(@$flat_name) }}</span>
    @endif
</div>
