<div class="card-body">
        @csrf
        @method('put')

        @include('alerts.success')

        <div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
            <input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{ old('id', '') }}">
            @include('alerts.feedback', ['field' => 'id'])
        </div>
        <div class="input-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="tim-icons icon-single-02"></i>
                </div>
            </div>
            <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('nombre', '') }}">
            @include('alerts.feedback', ['field' => 'nombre'])
        </div>
        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="tim-icons icon-email-85"></i>
                </div>
            </div>
            <input type="email" id="email" name="correo" class="form-control{{ $errors->has('correo') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('correo', '') }}">
            @include('alerts.feedback', ['field' => 'correo'])
        </div>
        <div class="input-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-phone"></i>
                </div>
            </div>
            <input type="text" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefono') }}" value="{{ old('telefono', '') }}">
            @include('alerts.feedback', ['field' => 'telefono'])
        </div>
        <div class="input-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-address-card"></i>
                </div>
            </div>
            <input type="text" name="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" placeholder="{{ __('direccion') }}" value="{{ old('direccion', '') }}">
            @include('alerts.feedback', ['field' => 'direccion'])
        </div>
        <div class="input-group{{ $errors->has('rfc') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-key"></i>
                </div>
            </div>
            <input type="text" name="rfc" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" placeholder="{{ __('rfc') }}" value="{{ old('rfc', '') }}">
            @include('alerts.feedback', ['field' => 'rfc'])
        </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-fill btn-primary" onclick="editarUsuario()">{{ __('Guardar') }}</button>
</div>

