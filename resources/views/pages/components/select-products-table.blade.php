@if(isset($productos))
    @foreach ($productos as $producto)
        <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6" style="padding-bottom: 0px;"
            onclick="addProducto({{$producto}})">
            <div class="font-icon-detail" style="padding-bottom: 0px;" id="{{$producto->id}}">
                <p style="position:relative;
                top:-75px; font-size: 14px; padding-bottom: 0px;">ID: {{$producto['id']}}
                    <br>
                    Nombre: {{$producto['nombre']}}
                    <br>
                    Precio: {{$producto['precio']}}
                    <br>
                    Existencia: {{$producto['existencia']}}</p>
            </div>
        </div>
    @endforeach
@endif
@if(!count($productos))
    <div class="typography-line" style="position: relative;padding-left: 30px;margin-right: 2.2%;">
        <blockquote>
            <p class="blockquote blockquote-primary">
                No hay resultados.
            </p>
        </blockquote>
    </div>
@endif
