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
        <label>{{ __('Descripción') }}</label>
        <div class="input-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
            </div>
            <input type="text" name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" placeholder="{{ __('descripcion') }}" value="{{ old('descripcion', '') }}">
            @include('alerts.feedback', ['field' => 'descripcion'])
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

</div>
<div class="card-footer">
    <button type="button" class="btn btn-fill btn-primary" onclick="editarUsuario()">{{ __('Editar insumo') }}</button>
</div>

