@extends('country::layouts.master')

@section('title', 'Ver Pais')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    @include('country::includes.alerts')

                    <div class="card-header">
                        <h3 class="card-title">Ver pais</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <input type="text" name="name" class="form-control" readonly value="{{ $country->name }}">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
