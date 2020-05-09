@foreach ($sales as $sale)
    <tr>
        <td>{{$sale->cliente->nombre}}</td>
        <td>{{$sale->empleado->name}}</td>
        <td>
            {{$sale['precio']}}
        </td>
        <td>{{$sale['fecha']}}</td>
        <td>{{$sale['estado']}}</td>
        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#clientes-modal" onclick="fillEditModal({{$sale->detalles}})">Devolver</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
