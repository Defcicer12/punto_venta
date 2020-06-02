<div class="card-body">
    @csrf
    @method('put')

    @include('alerts.success')

    <div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
        <input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{ old('id', '') }}">
        @include('alerts.feedback', ['field' => 'id'])
    </div>
    <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-single-02"></i>
            </div>
        </div>
        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', '') }}">
        @include('alerts.feedback', ['field' => 'name'])
    </div>
    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-email-85"></i>
            </div>
        </div>
        <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', '') }}">
        @include('alerts.feedback', ['field' => 'email'])
    </div>
    <div class="input-group{{ $errors->has('departamento') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <select type="select" name="departamento" class="form-control{{ $errors->has('departamento') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('departamento') == '' ? 'selected' : '' }}>Departamento</option>
            <option style="color:white; background-color:#27293D;" {{ old('departamento') == 'Compras' ? 'selected' : '' }}  value="Compras">Compras</option>
            <option style="color:white; background-color:#27293D;" {{ old('departamento') == 'Ventas' ? 'selected' : '' }}  value="Ventas">Ventas</option>
            <option style="color:white; background-color:#27293D;" {{ old('departamento') == 'Almacen' ? 'selected' : '' }}  value="Almacen">Almacen</option>
        </select>
        @include('alerts.feedback', ['field' => 'departamento'])
    </div>
    <div class="input-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-single-02"></i>
            </div>
        </div>
        <input type="number" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefono') }}" value="{{ old('telefono', '') }}">
        @include('alerts.feedback', ['field' => 'telefono'])
    </div>
</div>
<div class="card-footer">
<button type="button" class="btn btn-fill btn-primary" onclick="editarUsuario()">{{ __('Save') }}</button>
</div>

