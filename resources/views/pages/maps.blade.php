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
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Registrar pagos</button>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Clientes">Nuevo cliente</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal modal-black fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pagos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Edit Profile') }}</h5>
                    </div>
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        <div class="card-body">
                                @csrf
                                @method('put')

                                @include('alerts.success')

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label>{{ __('Email address') }}</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
    productos_agregados = [];

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
                            <input type="text" value="1" class="form-control" name="cantidad`+producto.id+`">
                        </td>
                    </tr>`
            $('#' + producto.id).css('border-width', "5px");
            $('#t-body').append(html);
        }else{
            delete productos_agregados['prod'+producto.id];
            $('#' + producto.id).css('border-width', "1px");
            $( ".tr-"+producto.id ).remove();
        }
    }

    async function Confirmar(){
        //searchw: http://punto_venta.test/product/searchw
        precio = 0;
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
                            else
                                showNotification('sicharcho','success');
                        }
        });
    }

    async function searchWithoutReload(){
        //searchw: http://punto_venta.test/product/searchw
        search  = await $('#q').val();
        await $.ajax({
            type: "GET",
            url: "http://punto_venta.test/product/searchw",
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

</script>
@endsection
