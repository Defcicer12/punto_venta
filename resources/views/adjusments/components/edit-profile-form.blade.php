<div class="card-body">
        @csrf
        @method('put')

        @include('alerts.success')

        <div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
            <input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{ old('id', '') }}">
            @include('alerts.feedback', ['field' => 'id'])
        </div>
        <label>{{ __('Name') }}</label>
        <div class="input-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-laptop"></i>
                </div>
            </div>
            <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('nombre', '') }}">
            @include('alerts.feedback', ['field' => 'nombre'])
        </div>
        <label>{{ __('Existencia') }}</label>
        <div class="input-group{{ $errors->has('existencia') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
            </div>
            <input type="number" name="existencia" class="form-control{{ $errors->has('existencia') ? ' is-invalid' : '' }}" placeholder="{{ __('Existencia') }}" value="{{ old('existencia', '') }}">
            @include('alerts.feedback', ['field' => 'existencia'])
        </div>
        <label>{{ __('Precio') }}</label>
        <div class="input-group{{ $errors->has('precio') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <input type="number" id="precio" name="precio" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" placeholder="{{ __('Precio') }}" value="{{ old('precio', '') }}">
            @include('alerts.feedback', ['field' => 'precio'])
        </div>
        <label>{{ __('Cantidad mínima') }}</label>
        <div class="input-group{{ $errors->has('cantidad_minima') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-battery-quarter"></i>
                </div>
            </div>
            <input type="number" id="cantidad_minima" name="cantidad_minima" class="form-control{{ $errors->has('cantidad_minima') ? ' is-invalid' : '' }}" placeholder="{{ __('Cantidad mínima') }}" value="{{ old('cantidad_minima', '') }}">
            @include('alerts.feedback', ['field' => 'cantidad_minima'])
        </div>
        <label>{{ __('Cantidad Máxima') }}</label>
        <div class="input-group{{ $errors->has('cantidad_maxima') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-battery-full"></i>
                </div>
            </div>
            <input type="number" name="cantidad_maxima" class="form-control{{ $errors->has('cantidad_maxima') ? ' is-invalid' : '' }}" placeholder="{{ __('Cantidad Máxima') }}" value="{{ old('cantidad_maxima', '') }}">
            @include('alerts.feedback', ['field' => 'cantidad_maxima'])
        </div>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-fill btn-primary" onclick="editarUsuario()">{{ __('Save') }}</button>
</div>

