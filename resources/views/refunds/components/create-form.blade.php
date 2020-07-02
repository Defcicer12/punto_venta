@csrf
@include('alerts.success')


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Agregar cliente') }} <span id='ct' ></span></h5></h5>
            </div>
            <div class="card-body">

                @csrf
                <div id="load-id">
                    @include('refunds\components\id-fill')
                </div>

                <div id="load-select">
                    @include('refunds\components\products-select')
                </div>

                <div class="card-footer" id="client-fill">
                    @include('refunds\components\products-fill')
                </div>

        </div>
    </div>

<div class="card-footer">
    <button type="button" onclick="agregarInsumo()" class="btn btn-primary btn-round btn-lg">{{ __('Agregar insumo') }}</button>
</div>

<table class="table tablesorter ">
    <thead class=" text-primary">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Subtotal</th>
        </tr>
    </thead>
    <tbody id="added-table">
        @include('refunds\components\order-products-table')
    </tbody>
</table>
<button type="button" onclick="concluir()" class="btn btn-primary btn-round btn-lg">{{ __('Concluir') }}</button>
