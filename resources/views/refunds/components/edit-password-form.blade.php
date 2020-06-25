@if (isset($productos))
    @foreach ($productos as $producto)
        <tr class="tr">
            <td>
                {{$producto->producto->nombre}}
            </td>
            <td>
                {{$producto['id_venta']}}
            </td>
            <td>
                {{$producto['precio']*1.16}}
            </td>
            <td>
                {{$producto['cantidad']}}
            </td>
            <td class="text-primary" style="width: 10%;">
            <input type="number" value="{{$producto['cantidad']}}" class="form-control" id="cantidad-{{$producto['id_producto']}}">
            </td>
            <td class="text-primary" style="width: 25%;">
                <input type="text" placeholder="Razón de devolución" class="form-control" id="{{$producto['id_producto']}}">
            </td>
            <td class="text-center">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                        role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#" onclick="devolverProducto({{$producto}})">Devolver</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
@endif
