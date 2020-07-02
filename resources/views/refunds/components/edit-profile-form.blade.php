<div class="card-body">
    @csrf
    @method('put')

    @include('alerts.success')
    @isset($orden)
        <div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
        <input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{$orden->id}}">
            @include('alerts.feedback', ['field' => 'id'])
        </div>
    @endisset
    <label>{{ __('Diagnóstico') }}</label>
    <div class="input-group{{ $errors->has('diagnostico') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-laptop"></i>
            </div>
        </div>
        <input type="text" name="diagnostico" class="form-control{{ $errors->has('diagnostico') ? ' is-invalid' : '' }}" placeholder="{{ __('Diagnostico') }}" value="{{ old('diagnostico', '') }}">
        @include('alerts.feedback', ['field' => 'diagnostico'])
    </div>

</div>
<div class="card-footer">
<button type="button" class="btn btn-fill btn-primary" onclick="diagnosticar()">{{ __('Diagnosticar') }}</button>
</div>

