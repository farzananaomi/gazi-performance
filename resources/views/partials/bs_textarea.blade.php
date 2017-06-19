<?php
    if (preg_match('/^(.+?)\[(.+?)\]$/i', $name)) {
        $flat_name = preg_replace('/^(.+?)\[(.+?)\]$/i', '$1.$2', $name);
    } else {
        $flat_name = $name;
    }
?>

<div class="form-group {{ $errors->has(@$flat_name)? 'has-error':'' }}">
    <label for="{{ @$name }}" class="control-label">{{ @$label }}</label>
    <textarea class="form-control" name="{{ @$name }}" id="{{ @$name }}" placeholder="{{ @$placeholder }}" {!! $extras or '' !!}>{{ isset($useOld)? old($flat_name, $useOld):'' }}</textarea>

    @if($errors->has(@$flat_name))
        <span class="help-block">{{ $errors->first(@$flat_name) }}</span>
    @endif
</div>
