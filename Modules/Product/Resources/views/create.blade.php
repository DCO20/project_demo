@extends('product::layouts.master')

@section('title', 'Produtos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Produtos</li>
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
                <form action="{{ route('product.store') }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados da Produtos
                            </h3>
                        </div>

                        <div class="card-body">


                            <div class="row">

                                {{-- Nome --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nome:<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Ativo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ativo:<span class="text-danger">*</span></label>
                                        <select name="active" class="form-control" style="width: 100%;" required>

                                            <option value="">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>

                                        </select>
                                    </div>
                                </div>

                                {{-- Preço --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Preço:<span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control money" required>
                                    </div>
                                </div>

                                {{-- Categorias --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Categorias:<span class="text-danger">*</span></label>
                                        <select name="categories[]" multiple="multiple" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descrição:</label>
                                        <textarea name="description" id="summernote" cols="50" rows="5" class="form-control"></textarea>
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
    <script src="{{ mix('js/product.js') }}"></script>
@endsection
