@extends('layouts.app', ['page' => __('Caja'), 'pageSlug' => 'caja'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Productos') }}</h5>
            </div>
                <div class="card-body">
                    @csrf
                    <button type="submit" id="search" class="btn btn-sm btn-primary" onclick="searchWithoutReload()" style="position: absolute;
                        right: 10px;
                        top: 5px;
                        margin-right: 10px;">
                        <a class="tim-icons icon-zoom-split"></a>
                    </button>
                    <input type="text" class="form-control" name="q" id="q" placeholder="Buscar productos por nombre" onkeyup="searchWithoutReload()">
                </div>
                <div class="row" style="position: relative;padding-left: 30px;margin-right: 2.2%;" id="product-selection">
                    @include('pages.components.select-products-table')
                </div>

        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Productos Agregados') }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            ID
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Existencia
                        </th>
                        <th>
                            Precio
                        </th>
                        <th>
                            Cantidad
                        </th>
                    </thead>
                    <tbody id="t-body">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Agregar cliente') }}</h5>
            </div>
            <div class="card-body">
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label>{{ __('Name') }}</label>
                    <select type="text" name="name" class="form-control" id="select-cliente">
                        <option style="color:white; background-color:#27293D;" value="1"selected>Cliente</option>
                        @foreach ($clientes as $cliente)
                            <option style="color:white; background-color:#27293D;" value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                        @endforeach
                    </select>
                    @include('alerts.feedback', ['field' => 'name'])
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" onclick="Confirmar()" class="btn btn-sm btn-primary">{{ __('Confirmar orden') }}</button>
                <button type="button" id="pagos" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Registrar pagos</button>
                <button type="button" id="clientes" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Clientes">Nuevo cliente</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal modal-black fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="labelpagos">Pagos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('payment.create') }}" autocomplete="off" id="form">

                    @csrf
                    @method('post')

                    @include('alerts.success')

                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label>{{ __('Tipo') }}</label>
                        <select type="text" id="tipo-pago" name="tipo" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Tipo') }}" value="{{ old('name', auth()->user()->name) }}">
                        <option style="color:white; background-color:#27293D;" selected>Tipo</option>
                        <option style="color:white; background-color:#27293D;" value="Efectivo">Efectivo</option>
                        <option style="color:white; background-color:#27293D;" value="Con tarjeta">Con tarjeta</option>
                        <option style="color:white; background-color:#27293D;" value="Credito en tienda">Credito en tienda</option>
                        </select>
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>

                    <div class="form-group{{ $errors->has('monto') ? ' has-danger' : '' }}" id="pago-monto">
                        <label>{{ __('Monto') }}</label>
                        <input type="number" id="monto-pago" name="monto" class="form-control{{ $errors->has('monto') ? ' is-invalid' : '' }}" placeholder="{{ __('Monto') }}" value="{{ old('monto', auth()->user()->monto) }}">
                        @include('alerts.feedback', ['field' => 'monto'])
                    </div>
            </div>
            <div class="table-responsive" style="margin-left: 20px">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            ID
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Monto
                        </th>
                        <th>
                            Fecha
                        </th>
                    </thead>
                    <tbody id="t-body-pagos">
                        @include('pages.components.payments-table')
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="mostrarPagos()" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal2 -->
<div class="modal modal-black fade" id="Clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Clientes
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
<script>
    // window.onload = hideElement;
    productos_agregados = [];
    pagos_agregados = [];
    venta = [];
    contador_pagos = 1;

    function addProducto(producto) {
        if ( !$( ".tr-"+producto.id ).length ) {
            productos_agregados['prod'+producto.id] = producto;
            html = `<tr class="tr-`+producto.id+`">
                        <td>
                            `+producto.id+`
                        </td>
                        <td>
                            `+producto.nombre+`
                        </td>
                        <td>
                            `+producto.existencia+`
                        </td>
                        <td>
                            $`+producto.precio+`
                        </td>
                        <td class="text-primary" style="width: 10%;">
                            <input type="number" value="1" class="form-control" name="cantidad`+producto.id+`">
                        </td>
                    </tr>`
            $('#' + producto.id).css('border-width', "5px");
            $('#t-body').append(html);
        }else{
            delete productos_agregados['prod'+producto.id];
            $('#' + producto.id).css('border-width', "1px");
            $( ".tr-"+producto.id ).remove();
        }
        if(isEmpty(productos_agregados))
            $('#pagos').hide();
        else{
            $('#pagos').show();
        }
    }

    function hideElement(){
        $('#pagos').hide();
    }

    function addPago(pago) {
        if ( !$( ".tr-"+pago.id ).length ) {
            pagos_agregados['pago'+pago.id] = pago;
            html = `<tr class="tr-`+pago.id+`">
                        <td>
                            `+pago.id+`
                        </td>
                        <td>
                            `+pago.nombre+`
                        </td>
                        <td>
                            `+pago.existencia+`
                        </td>
                        <td>
                            $`+pago.precio+`
                        </td>
                        <td class="text-primary" style="width: 10%;">
                            <input type="number" value="1" class="form-control" name="cantidad`+pago.id+`">
                        </td>
                    </tr>`
            $('#' + pago.id).css('border-width', "5px");
            $('#t-body').append(html);
            contador++;
        }else{
            delete pagos_agregados['pago'+pago.id];
            $('#' + pago.id).css('border-width', "1px");
            $( ".tr-"+pago.id ).remove();
        }
    }

    async function Confirmar(){
        //searchw: http://punto_venta.test/product/searchw
        productos = [];
        for (var key in productos_agregados) {
            productos_agregados[key].cantidad  = await $('input[name ="cantidad'+productos_agregados[key].id+'"]').val();
            productos.push(productos_agregados[key]);
        }
        console.log(productos);

        await $.ajax({
            type: "POST",
            url: "{{  route('sale.create') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id_empleado: "{{ Auth::user()->id }}",
                id_cliente: $("#select-cliente option:selected").val(),
                productos: productos,
                    },
            success: function(response){
                console.log(response)
                            if(response['sucess'] == 0)
                                showNotification(response['errors'],'danger');
                            else{
                                venta = response;
                                $('#labelpagos').append(' <p class="label_total" style="text-align: center;">Total de venta: '+venta.precio+'</p>');
                                $('#pago-monto').append(`
                                <div hidden class="form-group{{ $errors->has('monto') ? ' has-danger' : '' }}" id="pago-monto">
                                    <label>{{ __('id_venta') }}</label>
                                    <input type="number" id="id_venta" hidden value="`+venta.id+`" name="id_venta" class="form-control{{ $errors->has('monto') ? ' is-invalid' : '' }}" placeholder="{{ __('Monto') }}" value="{{ old('monto', auth()->user()->monto) }}">
                                    @include('alerts.feedback', ['field' => 'monto'])
                                </div>`
                                )
                                showNotification('sicharcho','success');
                            }
                        }
        });
    }

    async function mostrarPagos(){
        await $.ajax({
            type: "POST",
            url: "{{ route('payment.create') }}",
            data: {
                _token: "{{ csrf_token() }}",
                tipo: $('#tipo-pago option:selected').val(),
                monto: $('#monto-pago').val(),
                id_venta: $('#id_venta').val()
            },
            success: function(response){
                if(response['success']==0){
                    showNotification(response['errors'],'danger');
                }else{
                    console.log(response);
                    // pagos_agregados.push() = response['new'];
                    $('.label_total').text('Total de venta:'+response['data']['monto_venta']+' Por Cubrir:'+response['data']['monto_por_cubrir']);
                }
            }
        });

        await $.ajax({
            type: "GET",
            url: "{{ route('payment.searchw') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id_venta: $('#id_venta').val()
            },
            success: function(response){
                            $('#t-body-pagos').html(response)
                        }
        });
    }

    async function searchWithoutReload(){
        //searchw: http://punto_venta.test/product/searchw
        search  = await $('#q').val();
        await $.ajax({
            type: "GET",
            url: "{{ route('sale.searchw') }}",
            data: {q: search},
            success: function(response){
                            $('#product-selection').html(response)
                        }
        });
    }

    //notificacion
    function showNotification(message,type) {
    color = Math.floor((Math.random() * 4) + 1);

    $.notify({
      icon: "tim-icons icon-bell-55",
      message: message

    }, {
      type: type,
      timer: 5000,
      placement: {
        from: 'top',
        align: 'center'
      }
    });
  }

  function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

</script>
@endsection
