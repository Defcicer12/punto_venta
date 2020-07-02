@extends('layouts.app', ['page' => __('Ordenes'), 'pageSlug' => 'devoluciones'])

@section('content')
<body class="">
    <div class="wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-2">
                                        <h4 class="card-title">Ordenes</h4>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="q" id="q" placeholder="Buscar Ordenes" onkeyup="searchWithoutReload()">
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="">
                                    <table class="table tablesorter ">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">Empleado</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users-table">
                                            @include('refunds.components.refunds-table')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer py-4">
                                <nav class="d-flex justify-content-end" aria-label="...">

                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card" id="close-create">
                            @include('refunds.components.close-modal-create')
                        </div>
                    </div>
                </div>
            </div>
    {{-- Modal --}}
    <div class="modal modal-black fade" id="clientes-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="position: relative; bottom: 0%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Diagnostico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit-modal-body">
                    @include('refunds\components\modal-edit')
                </div>
            </div>
        </div>
    </div>
    {{-- Modal2 --}}
    <div class="modal modal-black fade" id="clientes-modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="position: relative; bottom: 0%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('refunds\components\modal-create')
                </div>
            </div>
        </div>
    </div>

</body>

@stack('js')
<script>
    async function searchWithoutReload(){
        //searchw: http://punto_venta.test/product/searchw
        search  = await $('#q').val();
        await $.ajax({
            type: "GET",
            url: "{{ route('orden.searchw') }}",
            data: {q: search},
            success: function(response){
                            $('#users-table').html(response)
                        }
        });
    }

    async function reloadFill(){
        await $.ajax({
            type: "post",
            url: "{{ route('components.products-fill') }}",
            data:{
            _token: "{{ csrf_token() }}",
            id: $("#select-cliente option:selected").val()
            },
            success: function(response){
                            $('#client-fill').html(response)

                        }
        });
        console.log(await $('#order-info').serialize());
    }

    async function fillDiagnosticoModal(id){
        console.log(id)
        await $.ajax({
            type: "post",
            url: "{{ route('components.refund-diagnostico') }}",
            data:{
            _token: "{{ csrf_token() }}",
            id: id},
            success: function(response){
                            $('#modal-edit-form').html(response)
                        }
        });
    }

    async function fillConcluidoModal(id){
        console.log(id)
        await $.ajax({
            type: "post",
            url: "{{ route('components.refund-concluido') }}",
            data:{
            _token: "{{ csrf_token() }}",
            id: id},
            success: function(response){
                            $('#load-id').html(response)
                            reloadProductsTable(id);
                        }
        });
    }

    async function fillCloseModal(id){
        console.log(id)
        await $.ajax({
            type: "post",
            url: "{{ route('components.refund-close') }}",
            data:{
            _token: "{{ csrf_token() }}",
            id: id},
            success: function(response){
                            $('#close-create').html(response)
                        }
        });
    }

    async function pendiente(id){

        await $.ajax({
            type: "PUT",
            url: "{{ route('orden.pendiente') }}",
            data: {
            _token: "{{ csrf_token() }}",
            id: id},
            success: function(response){
                            reloadTable();
                            $('#modal-edit-form').html(response)
                        }
        });
    }

    async function reparacion(id){

        await $.ajax({
            type: "PUT",
            url: "{{ route('orden.reparacion') }}",
            data: {
            _token: "{{ csrf_token() }}",
            id: id},
            success: function(response){
                            reloadTable();
                            $('#modal-edit-form').html(response)
                        }
        });
    }

    async function concluir(){

        await $.ajax({
            type: "PUT",
            url: "{{ route('orden.concluir') }}",
            data: {
            _token: "{{ csrf_token() }}",
            id: $('#id_orden').val()},
            success: function(response){
                            reloadTable();
                            $('#modal-edit-form').html(response)
                        }
        });
    }

    async function cerrar(){
        data = $('#close-form').serialize();
        await $.ajax({
            type: "PUT",
            url: "{{ route('orden.cerrar') }}",
            data: data,
            success: function(response){
                            reloadTable();
                            $('#close-create').html(response)
                        }
        });
    }

    async function reloadTable(){
        await $.ajax({
            type: "post",
            url: "{{ route('components.refund-table') }}",
            data: {
                _token: "{{csrf_token()}}",
                q: ''},
            success: function(response){
                            $('#users-table').html(response)
                        }
        });
    }

    function showmodal()
    {
    $("#close-modal-create").modal("show");
    }
</script>
@stack('js')
@endsection
