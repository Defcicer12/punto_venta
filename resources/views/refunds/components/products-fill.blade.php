@isset($selected)
<label >descripcion</label>
<input type="text" name="descripcion" value="{{ $selected->descripcion }}" class="form-control" style="color: #C0C0C0;" readonly>
<label >Nombre</label>
<input type="text" name="nombre" value="{{ $selected->nombre }}" class="form-control" style="color: #C0C0C0;" readonly>
<label >precio</label>
<input type="number" name="precio" id="precio" value="{{ $selected->precio }}" class="form-control" style="color: #C0C0C0;" readonly>
<label >Cantidad *</label>
<input type="number" name="cantidad" id="cantidad" value="" class="form-control" style="color: #C0C0C0;">
@endisset
