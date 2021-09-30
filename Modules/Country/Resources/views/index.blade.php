@extends('country::layouts.master')

@section('title', 'Paises')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="mt-3 ml-3">
                        <a href="{{ route('country.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Novo</a>
                        </a>
                    </div>

                    @include('country::includes.alerts')

                    <!-- /.card-header -->
                    <div class="card-body">

                        <input type="hidden" id="route_datatable_country" value="">

                        <table class="table table-bordered table-striped" id="ajax-datatable-country">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
