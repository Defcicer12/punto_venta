@foreach ($adjusments as $adjusment)
    <tr>
        <td>{{$adjusment['id']}}</td>
        <td>
            {{$adjusment['tipo']}}
        </td>
        <td>{{$adjusment['fecha']}}</td>
        <td>{{$adjusment['monto']}}</td>
        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#clientes-modal" onclick="fillEditModal({{$adjusment}})">Edit</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
