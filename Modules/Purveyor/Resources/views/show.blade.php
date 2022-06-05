@extends('purveyor::layouts.master')

@section('title', 'Fornecedores')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Fornecedores</li>
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
                            Dados do Fornecedores
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            {{-- Nome --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome:</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $purveyor->name }}">
                                </div>
                            </div>

                            {{-- CNPJ --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>CNPJ:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control mask-cnpj" readonly value="{{ $purveyor->cnpj }}">
                                    </div>
                                </div>

                            {{-- Ativo --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ativo:</label>
                                    <input type="text" class="form-control" readonly value="{{ $purveyor->formatted_active }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            Dados da Categorias
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Categorias --}}
                            <div class="col-md-12">
                                <div class="row">

                                    @foreach ($purveyor->categories as $category)

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" checked disabled>
                                                    <label class="form-check-label">{{ $category->name }}</label>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="row">
                    <div class="col-sm-2 text-right">
                        <a href="{{ route('purveyor.edit', $purveyor->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                        <a href="{{ route('purveyor.confirm_delete', $purveyor->id) }}" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/purveyor.js') }}"></script>
@endsection
