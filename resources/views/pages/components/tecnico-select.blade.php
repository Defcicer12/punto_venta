<select type="text" name="id_empleado" class="form-control" id="select-tecnico" onchange="reloadTecnicoFill()">
    <option style="color:white; background-color:#27293D;" value="0"selected>Técnico</option>
    @foreach ($tecnicos as $tecnico)
        <option style="color:white; background-color:#27293D;" value="{{$tecnico->id}}">{{$tecnico->id}} : {{$tecnico->name}}</option>
    @endforeach
</select>
