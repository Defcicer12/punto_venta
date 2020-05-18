@csrf
@include('alerts.success')

<div class="card-body">
    <div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
        <input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{ old('id', '') }}">
        @include('alerts.feedback', ['field' => 'id'])
    </div>
    <label>{{ __('Tipo') }}</label>
    <div class="input-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <select type="select" name="tipo" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == '' ? 'selected' : '' }}>Tipo</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Compras' ? 'selected' : '' }}  value="Compras">Venta</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Ventas' ? 'selected' : '' }}  value="Ventas">Devolucion</option>
        </select>
        @include('alerts.feedback', ['field' => 'tipo'])
    </div>
    <label>{{ __('producto') }}</label>
    <div class="input-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <select type="select" name="tipo" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == '' ? 'selected' : '' }}>Tipo</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Compras' ? 'selected' : '' }}  value="Compras">Venta</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Ventas' ? 'selected' : '' }}  value="Ventas">Devolucion</option>
        </select>
        @include('alerts.feedback', ['field' => 'tipo'])
    </div>
    <label>{{ __('empleado') }}</label>
    <div class="input-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <select type="select" name="tipo" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == '' ? 'selected' : '' }}>Tipo</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Compras' ? 'selected' : '' }}  value="Compras">Venta</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Ventas' ? 'selected' : '' }}  value="Ventas">Devolucion</option>
        </select>
        @include('alerts.feedback', ['field' => 'tipo'])
    </div>
    <label>{{ __('Cantidad') }}</label>
    <div class="input-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <input type="number" id="cantidad" name="cantidad" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" placeholder="{{ __('cantidad') }}" value="{{ old('cantidad', '') }}">
        @include('alerts.feedback', ['field' => 'cantidad'])
    </div>
    <label>{{ __('Cantidad') }}</label>
    <div class="input-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <input type="number" id="cantidad" name="cantidad" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" placeholder="{{ __('cantidad') }}" value="{{ old('cantidad', '') }}">
        @include('alerts.feedback', ['field' => 'cantidad'])
    </div>
    <label>{{ __('descripcion') }}</label>
    <div class="input-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <input type="text" id="descripcion" name="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" placeholder="{{ __('descripcion') }}" value="{{ old('descripcion', '') }}">
        @include('alerts.feedback', ['field' => 'descripcion'])
    </div>
</div>
<div class="card-footer">
    <button type="button" onclick="crearUsuario()" class="btn btn-primary btn-round btn-lg">{{ __('Crear producto') }}</button>
</div>
