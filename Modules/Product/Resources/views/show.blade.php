@extends('product::layouts.master')

@section('title', 'Produtos')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Produtos</li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
            <div class="col-sm-2 text-right">
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">
                    <i class="fas fa-pen"></i> Editar
                </a>
                <a href="{{ route('product.confirm_delete', $product->id) }}" class="btn btn-danger">
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
                                    <label>Nome:</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $product->name }}">
                                </div>
                            </div>

                            {{-- Preço --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Preço:</label>
                                    <input type="text" name="price" class="form-control money" readonly value="{{ $product->formatted_price }}">
                                </div>
                            </div>

                            {{-- Ativo --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ativo:</label>
                                    <input type="text" class="form-control" readonly value="{{ $product->formatted_active }}">
                                </div>
                            </div>

                            {{-- Categorias --}}
                            <div class="col-md-12">
                                <label>Categorias:</label>
                                <div class="row">

                                    @foreach ($product->categories as $category)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-check" >
                                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" selected disabled>
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
            </div>
        </div>
    </div>

@endsection

@section('footer-extras')
    <script src="{{ mix('js/product.js') }}"></script>
@endsection
