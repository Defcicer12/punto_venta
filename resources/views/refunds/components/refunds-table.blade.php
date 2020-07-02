@foreach ($orders as $order)
    <tr>
        <td>{{$order->id}}</td>
        <td>{{$order->cliente->nombre}}</td>
        <td>{{$order->empleado->name}}</td>
        <td>
            {{$order->fecha}}
        </td>
        <td>{{$order->status}}</td>
        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>

                    <div
                        class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        @if ($order->status == "En revisión" && auth()->user()->tipo == "Técnico")
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#clientes-modal" onclick="fillDiagnosticoModal({{$order->id}})">Diagnosticar</a>
                        @endif
                        @if ($order->status == "Con diagnóstico" && auth()->user()->tipo == "Gerente")
                            <a class="dropdown-item" onclick="pendiente({{$order->id}})">Marcar como pendiente</a>
                        @endif
                        @if (($order->status == "Pendiente por cliente" || $order->status == "Con diagnóstico") && auth()->user()->tipo == "Gerente")
                            <a class="dropdown-item" onclick="reparacion({{$order->id}})">Marcar para reparación</a>
                        @endif
                        {{-- @if (($order->status == "En reparación") && auth()->user()->tipo == "Técnico") --}}
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#clientes-modal-create" onclick="fillConcluidoModal({{$order->id}})">Concluir reparación</a>
                        {{-- @endif --}}
                        @if (($order->status == "Concluida") && auth()->user()->tipo == "Gerente")
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#close-modal-create" onclick="fillCloseModal({{$order->id}})">Cerrar</a>
                        @endif
                    </div>

            </div>

        </td>
    </tr>
@endforeach

