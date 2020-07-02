<div class="card" id= "products-card">
    <div class="card-header">
        <h5 class="title">{{ __('Productos') }}
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
</div>
<div class="card">
    <div class="card-header">
        <h5 class="title">{{ __('Productos Agregados') }}</h5>
    </div>
    <div class="table-responsive" id="tabla-agregados">
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
        <div id="totales" style="text-align: center">

        </div>
    </div>
</div>
