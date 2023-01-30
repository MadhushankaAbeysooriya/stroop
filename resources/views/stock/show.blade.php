@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $stock->item->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $stock->item->name }}</li>
                            <li class="breadcrumb-item ">Stock</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Stock</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$stock->item->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Issue Place</label>
                        <div class="col-sm-9">
                            <span>{{$establishment->issue_place}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Qty</label>
                        <div class="col-sm-9">
                            <span>{{$stock->qty}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Re-Order level</label>
                        <div class="col-sm-9">
                            <span>{{$stock->below_qty}}</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
@endsection

        @section('third_party_stylesheets')
            <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
        @stop

        @section('third_party_scripts')
            <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
@stop

