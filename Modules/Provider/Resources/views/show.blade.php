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
            <div class="col-sm-2 text-right">
                <a href="{{ route('provider.edit', $provider->id) }}" class="btn btn-primary">
                    <i class="fas fa-pen"></i> Editar
                </a>
                <a href="{{ route('provider.confirm_delete', $provider->id) }}" class="btn btn-danger">
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
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                Dados da Fornecedores
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">


                            <div class="row">

                                {{-- CNPJ --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CNPJ:</label>
                                        <input type="text" class="form-control mask-cnpj" readonly value="{{ $provider->cnpj }}">
                                    </div>
                                </div>


                                {{-- Razão social --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Razão social:</label>
                                        <input type="text" class="form-control" readonly value="{{ $provider->corporate_name }}">
                                    </div>
                                </div>


                                {{-- Nome Fantasia --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nome Fantasia:</label>
                                        <input type="text" class="form-control" readonly value="{{ $provider->fantasy_name }}">
                                    </div>
                                </div>

                                {{-- Ativo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ativo:</label>
                                        <input type="text" class="form-control" readonly value="{{ $provider->formatted_active }}">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer"></div>

                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                Observação
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                {{-- Observação --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observação:</label>
                                        <textarea name="note" id="summernote-disable" cols="50" rows="5" class="form-control">{!! $provider->note !!}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer"></div>

                    </div>

                    {{-- Botão que salva os dados --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus fa-fw"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/provider.js') }}"></script>
@endsection
