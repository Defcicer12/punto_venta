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
@if(!count($productos))
    <div class="typography-line" style="position: relative;padding-left: 30px;margin-right: 2.2%;">
        <blockquote>
            <p class="blockquote blockquote-primary">
                No hay resultados.
            </p>
        </blockquote>
    </div>
@endif
