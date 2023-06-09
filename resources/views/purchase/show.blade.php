@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $purchase->purchase_order_no }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $purchase->purchase_order_no }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Purchase Order</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="purchase_order_no">Purchase Order No</label>
                        <div class="col-sm-9">
                            <span>{{$purchase->purchase_order_no}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Sup_Name">Supplier</label>
                        <div class="col-sm-9">
                            <span>{{$purchase->supplier->Sup_Name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="vote_code">Vote Code</label>
                        <div class="col-sm-9">
                            <span>{{$purchase->vote->vote_code}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="issue_place">Received To</label>
                        <div class="col-sm-9">
                            <span>{{$purchase->received->issue_place}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="amount">Amount</label>
                        <div class="col-sm-9">
                            <span>{{$purchase->amount}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="p_order_remarks">Remarks</label>
                        <div class="col-sm-9">
                            <span>{{$purchase->p_order_remarks}}</span>
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
