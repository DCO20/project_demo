@extends('state::layouts.master')

@section('title', 'Estados')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Estados</li>
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
                            Dados do Estados
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            {{-- Nome --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input type="text" class="form-control" readonly value="{{ $state->name }}">
                                </div>
                            </div>

                            {{-- Sigla --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sigla:</label>
                                    <input type="text" class="form-control" readonly value="{{ $state->initial }}">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <form action="{{ route('state.delete', $state->id) }}" method="post">

                                {{-- Elementos Ocultos --}}
                                @csrf
                                @method('DELETE')

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Excluir
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="card-footer"></div>

                </div>
            </div>
        </div>
    </div>

@endsection
