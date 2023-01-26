@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $item->Item_Type }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $item->Item_Type }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Item</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="store_name">Relevent Stores</label>
                        <div class="col-sm-9">
                            <span>{{$item->stores->store_name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Category_Name">ICT Category</label>
                        <div class="col-sm-9">
                            <span>{{$item->ictcategory->Category_Name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Type_Name">Equipment Type</label>
                        <div class="col-sm-9">
                            <span>{{$item->equipment->Type_Name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="title_name">Title Name</label>
                        <div class="col-sm-9">
                            <span>{{$item->title->title_name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Item_Type">Item Name</label>
                        <div class="col-sm-9">
                            <span>{{$item->Item_Type}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Leger_No">Leger Card No</label>
                        <div class="col-sm-9">
                            <span>{{$item->Leger_No}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Make_Country">Manufactured Country</label>
                        <div class="col-sm-9">
                            <span>{{$item->Make_Country}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="measu_name">Unit Of Issues</label>
                        <div class="col-sm-9">
                            <span>{{$item->measure->measu_name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="reorder">Re-Order Level</label>
                        <div class="col-sm-9">
                            <span>{{$item->reorder}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="comreserve">Commander Reserve</label>
                        <div class="col-sm-9">
                            <span>{{$item->reorder}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="Item_Remarks">Remarks</label>
                        <div class="col-sm-9">
                            <span>{{$item->Item_Remarks}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Serial Number Available..?</label>
                        <div class="col-sm-5 input-group">
                            @if($item->is_serial == 1)
                                <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">Yes</mark>
                            @else
                                <mark class="px-2 text-white bg-danger rounded dark:bg-danger">No</mark>
                            @endif
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

