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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input type="text" name="name" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <form action="{{ route('country.delete', $country->id) }}" method="post">

                                {{-- Elementos Ocultos --}}
                                @csrf
                                @method('DELETE')

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Excluir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="card-footer"></div>

                </div>
            </div>
        </div>
    </div>

@endsection
