@extends('suit::layouts.master')

@section('title', 'Pedidos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Pedidos</li>
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
                <form action="{{ route('suit.delete', $suit->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('DELETE')
                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados do Pedido
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                {{-- Data do Pedido --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data do Pedido:</label>
                                        <input type="text" class="form-control" readonly value="{{ $suit->formatted_suit_date }}">
                                    </div>
                                </div>

                                {{-- Cliente --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cliente:</label>

                                        <select class="form-control select2" style="width: 100%;" disabled>

                                            @foreach ($suit->clients as $client)
                                                <option value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                            @endforeach

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
    <script src="{{ mix('js/suit.js') }}"></script>
@endsection
