@extends('country::layouts.master')

@section('title', 'Cadastro Pais')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @include('country::includes.alerts')

                    <div class="card-header">
                        <h3 class="card-title">Cadastrar um pais</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('country.store') }}" method="post">

                            @csrf

                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome: <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i>Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
