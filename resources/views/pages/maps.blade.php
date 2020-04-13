@extends('layouts.app', ['page' => __('Caja'), 'pageSlug' => 'caja'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Productos') }}</h5>
            </div>
            <form method="get" action="{{ route('product.search') }}" autocomplete="off">
                <div class="card-body">
                    @csrf
                    <button type="submit" id="search" class="btn btn-sm btn-primary" style="position: absolute;
                        right: 10px;
                        top: 5px;
                        margin-right: 10px;">
                        <a class="tim-icons icon-zoom-split"></a>
                    </button>
                    <input type="text" class="form-control" name="q" placeholder="Buscar productos por nombre">
                </div>
                <div class="row" style="position: relative;padding-left: 30px;margin-right: 2.2%;">
                    @if(isset($productos))
                    @foreach ($productos as $producto)
                    <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6"
                        onclick="addProducto({{$producto}})">
                        <div class="font-icon-detail" id="{{$producto->id}}">
                            <i class="tim-icons icon-alert-circle-exc"></i>
                            <p>{{$producto['nombre']}}</p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if(!isset($productos))
                    <div class="typography-line" style="position: relative;padding-left: 30px;margin-right: 2.2%;">
                        <blockquote>
                            <p class="blockquote blockquote-primary">
                                No hay resultados.
                            </p>
                        </blockquote>
                    </div>
                    @endif
                </div>
            </form>
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
                            Country
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
            <div class="card-footer">
                <button type="submit" onclick="Confirmar()" class="btn btn-sm btn-primary">{{ __('Change password') }}</button>
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
        // console.log(productos_agregados)
    }

    async function Confirmar(){

        for (var key in productos_agregados) {
            productos_agregados[key].cantidad  = await $('input[name ="cantidad'+productos_agregados[key].id+'"]').val();
            await $.ajax({
                type: "POST",
                url: "url",
                data: productos_agregados[key],
                success: function(response){
                                console.log(response);
                            }
            });
        }
        console.log(productos_agregados[key]);
    }

    //notificacion
    function showNotification(from, align) {
    color = Math.floor((Math.random() * 4) + 1);

    $.notify({
      icon: "tim-icons icon-bell-55",
      message: "Welcome to <b>Black Dashboard</b> - a beautiful freebie for every web developer."

    }, {
      type: type[color],
      timer: 8000,
      placement: {
        from: from,
        align: align
      }
    });
  }

</script>
@endsection
