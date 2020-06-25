<select type="text" name="name" class="form-control" id="select-cliente">
    <option style="color:white; background-color:#27293D;" value="1"selected>Cliente</option>
    @foreach ($clientes as $cliente)
        <option style="color:white; background-color:#27293D;" value="{{$cliente->id}}">{{$cliente->id}} : {{$cliente->nombre}}</option>
    @endforeach
</select>
