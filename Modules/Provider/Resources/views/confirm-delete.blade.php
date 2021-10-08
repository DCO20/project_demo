@extends('provider::layouts.master')

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

                            {{-- CNPJ --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CNPJ:</label>
                                    <input type="text" class="form-control" readonly value="{{ $provider->cnpj }}">
                                </div>
                            </div>

                            {{-- Razão social --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Razão social:</label>
                                    <input type="text" class="form-control" readonly value="{{ $provider->legal_name }}">
                                </div>
                            </div>

                            <div class="row">
                                <form action="{{ route('provider.delete', $provider->id) }}" method="post">

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
    </div>
@endsection

@section('footer-extras')
    <script src="{{ mix('js/provider.js') }}"></script>
@endsection
