<select type="text" name="id_insumo" class="form-control" id="select-cliente" onchange="reloadFill()">
    <option style="color:white; background-color:#27293D;" value="0"selected>Producto</option>
    @foreach ($products as $product)
        <option style="color:white; background-color:#27293D;" value="{{$product->id}}">{{$product->id}} : {{$product->nombre}}</option>
    @endforeach
</select>
