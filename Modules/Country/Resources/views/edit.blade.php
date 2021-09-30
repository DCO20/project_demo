@extends('country::layouts.master')

@section('title', 'País')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">País</li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')

    {{-- Respostas --}}
    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('country.update', $country->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

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
                                        <label>Nome:<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $country->name }}">
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
                                    <i class="fa fa-plus fa-fw"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
