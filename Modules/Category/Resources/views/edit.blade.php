@extends('category::layouts.master')

@section('title', 'Categorias')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Categorias</li>
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
                <form action="{{ route('category.update', $category->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados da Estados
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                {{-- Nome --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome:<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                    </div>
                                </div>

                                {{-- Ativo --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ativo:<span class="text-danger">*</span></label>
                                        <select name="active" class="form-control select2" style="width: 100%;">

                                            <option>Selecione</option>

                                            <option value="1" {{ old('active') == '1' ? 'selected' : ($category->active == '1' ? 'selected' : '') }}>
                                                Sim
                                            </option>
                                            <option value="0" {{ old('active') == '0' ? 'selected' : ($category->active == '0' ? 'selected' : '') }}>
                                                Não
                                            </option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            {{-- Descrição --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descrição:</label>
                                        <textarea name="description" id="summernote" cols="50" rows="5" class="form-control">{{ $category->description }}</textarea>
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
    <script src="{{ mix('js/category.js') }}"></script>
@endsection
