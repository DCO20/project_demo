@extends('client::layouts.master')

@section('title', 'Clientes')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Clientes</li>
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
                <form action="{{ route('client.update', $client->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

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
                                        <label>Nome:<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required value="{{ $client->name }}">
                                    </div>
                                </div>

                                {{-- Data de Nascimento --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Data de Nascimento:<span class="text-danger">*</span></label>
                                        <input type="date" name="date_birthday" class="form-control" required value="{{ $client->formatted_date_birthday }}">
                                    </div>
                                </div>

                                {{-- Mensalidade --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mensalidade:<span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control money" required value="{{ $client->formatted_price }}">
                                    </div>
                                </div>

                                {{-- Ativo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ativo:<span class="text-danger">*</span></label>
                                        <select name="active" class="form-control select2" style="width: 100%;" required>

                                            <option value="1" @if ($client->active) selected @endif>Sim</option>
                                            <option value="0" @if (!$client->active)  selected @endif>Não</option>

                                        </select>
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

@section('footer-extras')
    <script src="{{ mix('js/client.js') }}"></script>
@endsection
