@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $supplier->Sup_Name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $supplier->Sup_Name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Supplier</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="Sup_Name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->Sup_Name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Addrs">Address</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->Addrs}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Tel">Contact No</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->Tel}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Fax">Fax No</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->Fax}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Email">Email</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->Email}}</span>
                        </div>
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