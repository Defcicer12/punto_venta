@isset($orden)
<div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
<input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{$orden->id}}" readonly>
    @include('alerts.feedback', ['field' => 'id'])
</div>
@endisset
