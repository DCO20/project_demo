@extends('product::layouts.master')

@section('title', 'Produtos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Produtos</li>
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
                <form action="{{ route('product.update', $product->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados do Produtos
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                {{-- Nome --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome:<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required value="{{ $product->name }}">
                                    </div>
                                </div>

                                {{-- Preço --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Preço:<span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control money" required value="{{ $product->formatted_price }}">
                                    </div>
                                </div>

                                {{-- Ativo --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ativo:<span class="text-danger">*</span></label>
                                        <select name="active" class="form-control select2" style="width: 100%;" required>

                                            <option value="1" @if ($product->active) selected @endif>Sim</option>
                                            <option value="0" @if (!$product->active)  selected @endif>Não</option>

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
                                Dados da Categorias
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                {{-- Categorias --}}
                                <div class="col-md-12">
                                    <label>Categorias:</label>
                                    <div class="row">

                                        @foreach ($product->categories as $category)

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" checked>
                                                        <label class="form-check-label">{{ $category->name }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                        @foreach ($categories as $category)

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}">
                                                        <label class="form-check-label">{{ $category->name }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

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
    <script src="{{ mix('js/product.js') }}"></script>
@endsection
