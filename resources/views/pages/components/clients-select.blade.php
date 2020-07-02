<select type="text" name="id_cliente" class="form-control" id="select-cliente" onchange="reloadFill()">
    <option style="color:white; background-color:#27293D;" value="0"selected>Cliente</option>
    @foreach ($clientes as $cliente)
        <option style="color:white; background-color:#27293D;" value="{{$cliente->id}}">{{$cliente->id}} : {{$cliente->nombre}}</option>
    @endforeach
</select>
