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
        <select id="tipo" onclick="unhideElement()" type="select" name="tipo" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == '' ? 'selected' : '' }}>Tipo</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Venta' ? 'selected' : '' }}  value="Venta">Venta</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Devolucion' ? 'selected' : '' }}  value="Devolucion">Devolucion</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Compra' ? 'selected' : '' }}  value="Compra">Compra</option>
            <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Otros' ? 'selected' : '' }}  value="Otros">Otros</option>
        </select>
        @include('alerts.feedback', ['field' => 'tipo'])
    </div>
    <div id="entrada_salida" class="input-group{{ $errors->has('salida') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <select type="select" name="salida" class="form-control{{ $errors->has('salida') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('salida') == '' ? 'selected' : '' }}>Entrada/Salida</option>
            <option style="color:white; background-color:#27293D;" {{ old('salida') == '0' ? 'selected' : '' }}  value="1">Salida</option>
            <option style="color:white; background-color:#27293D;" {{ old('salida') == '1' ? 'selected' : '' }}  value="0">Entrada</option>
        </select>
        @include('alerts.feedback', ['field' => 'salida'])
    </div>
    <label>{{ __('Producto') }}</label>
    <div class="input-group{{ $errors->has('id_producto') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <select type="select" name="id_producto" class="form-control{{ $errors->has('id_producto') ? ' is-invalid' : '' }}">
            <option style="color:white; background-color:#27293D;" {{ old('id_producto') == '' ? 'selected' : '' }}>Producto</option>
            @foreach ($productos as $producto)
                <option style="color:white; background-color:#27293D;" {{ old('id_producto') == $producto->id ? 'selected' : '' }}  value="{{$producto->id}}">{{$producto->nombre}}</option>
            @endforeach
        </select>
        @include('alerts.feedback', ['field' => 'id_producto'])
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
    <label>{{ __('Descripcion') }}</label>
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
<script>
    function unhideElement()
    {
            if($("#tipo").val() == 'Otros')
                $('#entrada_salida').show();
            else
                $('#entrada_salida').hide();

    }
</script>
