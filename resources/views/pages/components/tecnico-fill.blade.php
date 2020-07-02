@isset($tecnico)
<label >Nombre</label>
<input type="text" name="nombre" value="{{ $tecnico->name }}" class="form-control" style="color: #C0C0C0;" readonly>
@endisset
