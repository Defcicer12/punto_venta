<div class="card-body" id= "create-client-card">
    @csrf

    @include('alerts.success')
    <div class="input-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-single-02"></i>
            </div>
        </div>
        <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('nombre', '') }}">
        @include('alerts.feedback', ['field' => 'nombre'])
    </div>
    <div class="input-group{{ $errors->has('correo') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-email-85"></i>
            </div>
        </div>
        <input type="email" id="correo" name="correo" class="form-control{{ $errors->has('correo') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo') }}" value="{{ old('correo', '') }}">
        @include('alerts.feedback', ['field' => 'correo'])
    </div>
    <div class="input-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <input type="number" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefono') }}" value="{{ old('telefono', '') }}">
        @include('alerts.feedback', ['field' => 'telefono'])
    </div>
    <div class="input-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-single-02"></i>
            </div>
        </div>
        <input type="text" name="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" placeholder="{{ __('Direccion') }}" value="{{ old('direccion', '') }}">
        @include('alerts.feedback', ['field' => 'direccion'])
    </div>
    <div class="input-group{{ $errors->has('rfc') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-single-02"></i>
            </div>
        </div>
        <input type="text" name="rfc" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" placeholder="{{ __('Rfc') }}" value="{{ old('rfc', '') }}">
        @include('alerts.feedback', ['field' => 'rfc'])
    </div>
<button type="button" class="btn btn-fill btn-primary" onclick="crearUsuario()">{{ __('Crear cliente') }}</button>

</div>
