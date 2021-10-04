@extends('location::layouts.master')

@section('title', 'Localização')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-10">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">Localização</li>
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
                <form action="{{ route('location.update', $location->id) }}" method="post">

                    {{-- Elementos Ocultos --}}
                    @csrf
                    @method('PUT')

                    <div class="card card-outline card-secondary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Dados da Localização
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                {{-- Latitude --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Latitude:<span class="text-danger">*</span></label>
                                        <input type="text" name="lat" class="form-control" value="{{ $location->lat }}">
                                    </div>
                                </div>

                                {{-- Longitude --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Longitude:<span class="text-danger">*</span></label>
                                        <input type="text" name="long" class="form-control" value="{{ $location->lat }}">
                                    </div>
                                </div>

                                {{-- Países --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>País:<span class="text-danger">*</span></label>
                                        <select name="country_id" class="form-control select2" style="width: 100%;" required>

                                            <option value="">Selecione</option>

                                            <option value="{{ $location->country->id }}" selected>{{ $location->country->name }}</option>

                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach

                                        </select>
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
    <script src="{{ mix('js/location.js') }}"></script>
@endsection