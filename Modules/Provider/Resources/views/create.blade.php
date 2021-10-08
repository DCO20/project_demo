@extends('provider::layouts.master')

@section('title', 'Fornecedores')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Fornecedores</li>
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
                <form action="{{ route('provider.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

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
                                            <label>CNPJ:<span class="text-danger">*</span></label>
                                            <input type="text" name="cnpj" id="cnpj" class="form-control mask-cnpj" required>
                                            <span id="message" class="text-danger"></span>
                                        </div>
                                    </div>


                                    {{-- Razão social --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Razão social:<span class="text-danger">*</span></label>
                                            <input type="text" name="legal_name" id="legal_name" class="form-control" required>
                                        </div>
                                    </div>


                                    {{-- Nome Fantasia --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nome Fantasia:<span class="text-danger">*</span></label>
                                            <input type="text" name="trade_name" id="trade_name" class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Ativo --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ativo:<span class="text-danger">*</span></label>
                                            <select name="active" class="form-control select2" style="width: 100%;" required>
                                                <option value="">Selecione</option>
                                                <option value="1">Sim</option>
                                                <option value="0">Não</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer"></div>

                        </div>
                    </div>
                    <div class="card card-outline card-secondary">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Dados do Contato
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">


                                <div class="row" id="contact">

                                    {{-- Celular --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Celular:<span class="text-danger">*</span></label>
                                            <input type="text" name="phone_cell[]" class="form-control mask-phone-cell" required>
                                        </div>
                                    </div>

                                    {{-- Telefone Fixo --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email:<span class="text-danger">*</span></label>
                                            <input type="email" name="email[]" class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Adicionar --}}
                                    <div class="col-md-12">
                                        <div class="text-right">
                                            <a href="#" class="text-primary" id="add">Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer"></div>

                        </div>
                    </div>
                    <div class="card card-outline card-secondary">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Dados do Endereço
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">


                                <div class="row">

                                    {{-- CEP --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CEP:<span class="text-danger">*</span></label>
                                            <input type="text" name="zipcode" id="cep" class="form-control mask-zipcode" required>
                                        </div>
                                    </div>


                                    {{-- Logradouro --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Logradouro:<span class="text-danger">*</span></label>
                                            <input type="text" name="street" id="logradouro" class="form-control" required>
                                        </div>
                                    </div>


                                    {{-- Número --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Número:<span class="text-danger">*</span></label>
                                            <input type="text" name="number" class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Complemento --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Complemento:</label>
                                            <input type="text" name="complement" class="form-control">
                                        </div>
                                    </div>

                                    {{-- Bairro --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bairro:<span class="text-danger">*</span></label>
                                            <input type="text" name="district" id="bairro" class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Ponto de referência --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ponto de referência:</label>
                                            <input type="text" name="ref_point" class="form-control">
                                        </div>
                                    </div>

                                    {{-- Estado --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UF:<span class="text-danger">*</span></label>
                                            <select name="state" class="form-controll select2" id="uf" required style="width: 100%;">

                                                <option value="">Selecione</option>

                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->abbr }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    {{-- Cidade --}}
                                    <input type="hidden" id="route_load_address" value="{{ route('provider.loadcity') }}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cidade:<span class="text-danger"> *</span></label>
                                            <select name="city_id" class="form-controll select2" id="city" disabled style="width: 100%;">
                                                <option value="">Selecione</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer"></div>

                        </div>
                    </div>
                    <div class="card card-outline card-secondary">
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
                                            <textarea name="note" id="summernote" cols="50" rows="5" class="form-control"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="card-footer"></div>

                        </div>
                    </div>

                    {{-- Botão que salva os dados --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus fa-fw"></i> Cadastrar
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/provider.js') }}"></script>
@endsection
