@isset($selected)
<label >Telefono</label>
<input type="text" name="telefono" value="{{ $selected->telefono }}" class="form-control" style="color: #C0C0C0;" readonly>
<label >Nombre</label>
<input type="text" name="nombre" value="{{ $selected->nombre }}" class="form-control" style="color: #C0C0C0;" readonly>
<label >Email</label>
<input type="email" name="correo" id="correo" value="{{ $selected->correo }}" class="form-control" style="color: #C0C0C0;" readonly>
@endisset
