<div class="card-body">
    @csrf
    @method('put')

    @include('alerts.success')
    <label>{{ __('Costo de servicio') }}</label>
    <div class="input-group{{ $errors->has('costo_servicio') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-laptop"></i>
            </div>
        </div>
        <input type="number" name="costo_servicio" class="form-control{{ $errors->has('costo_servicio') ? ' is-invalid' : '' }}" placeholder="{{ __('costo_servicio') }}" value="{{ old('costo_servicio', '') }}">
        @include('alerts.feedback', ['field' => 'costo_servicio'])
    </div>
    <label>{{ __('Observaciones') }}</label>
    <div class="input-group{{ $errors->has('observaciones') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-laptop"></i>
            </div>
        </div>
        <input type="text" name="observaciones" class="form-control{{ $errors->has('observaciones') ? ' is-invalid' : '' }}" placeholder="{{ __('observaciones') }}" value="{{ old('observaciones', '') }}">
        @include('alerts.feedback', ['field' => 'observaciones'])
    </div>

</div>
<div class="card-footer">
<button type="button" class="btn btn-fill btn-primary" onclick="cerrar()">{{ __('Cerrar') }}</button>
</div>

