@foreach ($clients as $client)
    <tr>
        <td>{{$client['nombre']}}</td>
        <td>
            <a href="mailto:{{$client['correo']}}">{{$client['correo']}}</a>
        </td>
        <td>{{$client['direccion']}}</td>
        <td>{{$client['telefono']}}</td>
        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#clientes-modal" onclick="fillEditModal({{$client}})">Edit</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
