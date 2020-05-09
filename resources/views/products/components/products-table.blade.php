@foreach ($products as $product)
    <tr>
        <td>{{$product['nombre']}}</td>
        <td>
            {{$product['precio']}}
        </td>
        <td>{{$product['existencia']}}</td>
        <td>{{$product['cantidad_minima']}}</td>
        <td>{{$product['cantidad_maxima']}}</td>
        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div
                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#clientes-modal" onclick="fillEditModal({{$product}})">Edit</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
