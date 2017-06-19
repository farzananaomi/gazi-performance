<div class="form-group  {{ $errors->has(@$name)? 'has-error':'' }}">
    <label for="{{ @$name }}" class="control-label">{{ @$label }}</label>
    <input type="password" class="form-control" name="{{ @$name }}" id="{{ @$name }}" placeholder="{{ @$placeholder }}">

    @if($errors->has(@$name))
        <span class="help-block">{{ $errors->first(@$name) }}</span>
    @endif
</div>
