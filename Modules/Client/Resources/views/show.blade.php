@extends('client::layouts.master')

@section('title', 'Clientes')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Clientes</li>
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
                            Dados do Clientes
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Nome --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome:</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $client->name }}">
                                </div>
                            </div>

                            {{-- Data de Nascimento --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Data de Nascimento:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $client->formatted_date_birthday }}">
                                </div>
                            </div>

                             {{-- Gênero --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gênero:</label>
                                    <input type="text" class="form-control" readonly value="{{ $client->formatted_genre }}">
                                </div>
                            </div>

                            {{-- Mensalidade --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mensalidade:</label>
                                    <input type="text" class="form-control money" readonly value="{{ $client->formatted_price }}">
                                </div>
                            </div>

                            {{-- Ativo --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ativo:</label>
                                    <input type="text" class="form-control" readonly value="{{ $client->formatted_active }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="row">
                    <div class="col-sm-2 text-right">
                        <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                        <a href="{{ route('client.confirm_delete', $client->id) }}" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/client.js') }}"></script>
@endsection
