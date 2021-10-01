@extends('country::layouts.master')

@section('title', 'País')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">País</li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
            <div class="col-sm-2 text-right">
                <a href="{{ route('country.edit', $country->id) }}" class="btn btn-primary">
                    <i class="fas fa-pen"></i> Editar
                </a>
                <a href="{{ route('country.confirm_delete', $country->id) }}" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Excluir
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            Dados do País
                        </h3>
                    </div>

                    <div class="card-body">

                        {{-- Nome --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input type="text" name="name" class="form-control" readonly value="{{ $country->name }}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer"></div>

                </div>
            </div>
        </div>
    </div>

@endsection
