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
                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            Dados do Pedidos
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Data do Pedido --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Data do Pedido:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $suit->formatted_suit_date }}">
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="status" class="form-control select2" style="width: 100%;" disabled>

                                        <option value="{{ Suit::FINISHED }}" @if ($suit->status == Suit::FINISHED)  selected @endif>Finalizado</option>
                                        <option value="{{ Suit::PENDING }}" @if ($suit->status == Suit::PENDING) @endif>Pendente</option>

                                    </select>
                                </div>
                            </div>

                            {{-- Clientes --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Clientes:</label>
                                    <select multiple="multiple" class="form-control select2" style="width: 100%;" disabled>

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

                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            Observações
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            {{-- Observação --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Observação:</label>
                                    <textarea name="note" id="summernote-disable" cols="50" rows="5" class="form-control">{!! $suit->note !!}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer"></div>

                </div>

                <div class="row">
                    <div class="col-sm-2 text-right">
                        <a href="{{ route('suit.edit', $suit->id) }}" class="btn btn-primary">
                            <i class="fas fa-pen"></i> Editar
                        </a>
                        <a href="{{ route('suit.confirm_delete', $suit->id) }}" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/suit.js') }}"></script>
@endsection
