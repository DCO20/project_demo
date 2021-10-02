@extends('location::layouts.master')

@section('title', 'Localização')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Localização</li>
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
                            Dados do Localização
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            {{-- Latitude --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Latitude:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $location->lat }}">
                                </div>
                            </div>

                            {{-- Longitude --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Longitude:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" readonly value="{{ $location->lat }}">
                                </div>
                            </div>

                            {{-- Localizaçãoes --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Localização:<span class="text-danger">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" disabled>

                                        <option value="{{ $location->country->id }}" selected>{{ $location->country->name }}</option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <form action="{{ route('location.delete', $location->id) }}" method="post">

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
