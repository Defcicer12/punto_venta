@if(isset($pagos))
    @foreach ($pagos as $pago)
    <tr>
        <td>
            {{$pago->id}}
        </td>
        <td>
            {{$pago->tipo}}
        </td>
        <td>
            {{$pago->monto}}
        </td>
        <td>
            {{$pago->fecha}}
        </td>
    </tr>
    @endforeach
@endif
