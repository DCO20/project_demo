@extends('suit::layouts.master')

@section('title', 'Pedidos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Pedidos</li>
                    <li class="breadcrumb-item active">Cadastro</li>
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
                <form action="{{ route('suit.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    <input type="hidden" name="route_add_purveyor" value="{{ route('suit.add_purveyor') }}">

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
                                        <label>Data do pedido:<span class="text-danger">*</span></label>
                                        <input type="date" name="suit_date" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status:<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>
                                            <option value="{{ Suit::FINISHED }}">Finalizado</option>
                                            <option value="{{ Suit::PENDING }}">Pendente</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- Clientes --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Clientes:<span class="text-danger">*</span></label>
                                        <select name="clients[]" multiple="multiple" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

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
                                Dados do Pedido do Fornecedor
                            </h3>
                            {{-- Adicionar Fornecedor --}}
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <a href="javascript:void(0)" class="text-secondary add-purveyor" style="text-decoration: underline;">Adicionar</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div id="div-purveyors">
                                ​
                                @include('suit::partials.add-purveyor')
                                ​
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
                                        <textarea name="note" id="summernote" cols="50" rows="5" class="form-control"></textarea>
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
                                    <i class="fa fa-plus fa-fw"></i> Cadastrar
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
