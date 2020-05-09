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
                @include('refunds\components\edit-password-form')
            </tbody>
        </table>
    </div>
</div>
