@extends('layouts.app', ['page' => __('Administración de clientes'), 'pageSlug' => 'clients'])

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
                                        <h4 class="card-title">Clientes</h4>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="q" id="q" placeholder="Buscar productos" onkeyup="searchWithoutReload()">
                                    </div>
                                    <div class="col">
                                        <button type="button" id="clientes" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#clientes-modal-create">Añadir Cliente</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="">
                                    <table class="table tablesorter ">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Dirección</th>
                                                <th scope="col">Telefono</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="users-table">
                                            @include('clients.components.clients-table')
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
                </div>
            </div>
    {{-- Modal --}}
    <div class="modal modal-black fade" id="clientes-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="position: relative; bottom: 20%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit-modal-body">
                    @include('clients\components\modal-edit')
                </div>
            </div>
        </div>
    </div>
    {{-- Modal2 --}}
    <div class="modal modal-black fade" id="clientes-modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="position: relative; bottom: 25%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('clients\components\modal-create')
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
            url: "{{ route('client.searchw') }}",
            data: {q: search},
            success: function(response){
                            $('#users-table').html(response)
                        }
        });
    }
    async function fillEditModal(user){
        console.log(user)
        await $.ajax({
            type: "GET",
            url: "{{ route('components.client-edit-modal') }}",
            data: user,
            success: function(response){
                            $('#edit-modal-body').html(response)
                        }
        });
    }

    async function reloadTable(){
        await $.ajax({
            type: "GET",
            url: "{{ route('components.client-table') }}",
            data: {q: ''},
            success: function(response){
                            $('#users-table').html(response)
                        }
        });
    }
</script>
@stack('js')
@endsection
