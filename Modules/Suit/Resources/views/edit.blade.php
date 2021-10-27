@extends('suit::layouts.master')

@section('title', 'Pedidos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Pedidos</li>
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
                <form action="{{ route('suit.update', $suit->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados do Pedido
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                {{-- Data do Pedido --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Data do Pedido:<span class="text-danger">*</span></label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="suit_date" class="form-control datetimepicker-input" data-target="#reservationdate" required value="{{ $suit->formatted_suit_date }}" />
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status:<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control select2" style="width: 100%;" required>

                                            <option value="{{ Suit::FINISHED }}" @if ($suit->status == Suit::FINISHED)  selected @endif>Finalizado</option>
                                            <option value="{{ Suit::PENDING }}" @if ($suit->status == Suit::PENDING) @endif>Pendente</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- Clientes --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Clientes:<span class="text-danger">*</span></label>
                                        <select name="client_id" multiple="multiple" class="form-control select2" style="width: 100%;" required>

                                            @foreach ($suit->clients as $client)
                                                <option value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                            @endforeach

                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                                        <textarea name="description" id="summernote" cols="50" rows="5" class="form-control">{!! $suit->description !!}</textarea>
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
    <script src="{{ mix('js/suit.js') }}"></script>
@endsection
