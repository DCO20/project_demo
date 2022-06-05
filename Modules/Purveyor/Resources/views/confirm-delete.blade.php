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
                <form action="{{ route('purveyor.delete', $purveyor->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('DELETE')
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
                                        <label>Nome:</label>
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

                    {{-- Botão --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Excluir
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/purveyor.js') }}"></script>
@endsection
