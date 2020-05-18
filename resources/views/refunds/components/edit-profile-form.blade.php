@if (isset($devoluciones))
    @foreach ($devoluciones as $devolucion)
        <tr class="tr-1">
            <td>
                {{$devolucion['id']}}
            </td>
            <td>
                {{$devolucion['id_venta']}}
            </td>
            <td>
                {{$devolucion['cantidad']}}
            </td>
            <td>
                {{$devolucion['precio']}}
            </td>
            <td>
                {{$devolucion['descripcion']}}
            </td>
        </tr>
    @endforeach
@endif
