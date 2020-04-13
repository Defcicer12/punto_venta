@extends('layouts.app', ['page' => __('Administración'), 'pageSlug' => 'users'])

@section('content')
<body class="">
    <div class="wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-8">
                                        <h4 class="card-title">Users</h4>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-sm btn-primary col-4" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="btn btn-sm btn-primary">Add user</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="">
                                    <table class="table tablesorter " id="">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Departamento</th>
                                                <th scope="col">Telefono</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user['name']}}</td>
                                                <td>
                                                    <a href="mailto:{{$user['email']}}">{{$user['email']}}</a>
                                                </td>
                                                <td>{{$user['departamento']}}</td>
                                                <td>{{$user['telefono']}}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="#">Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
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
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('SEARCH') }}">
                            <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                                <i class="tim-icons icon-simple-remove"></i>
                          </button>
                        </div>
                    </div>
                </div>
            </div>
</body>
@endsection
