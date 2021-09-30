@extends('country::layouts.master')

@section('page_title', 'Cadastro Pais')

@section('content')

    {{-- Alertas --}}
    @include('country::includes.alerts')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('country.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Summernote
                            </h3>
                        </div>

                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer"></div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus fa-fw"></i> Cadastrar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
