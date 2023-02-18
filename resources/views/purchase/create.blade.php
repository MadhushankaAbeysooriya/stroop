@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Purchase Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Purchase Order</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add New Purchase Order</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('purchase.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="purchase_order_no">Purchase Order Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="purchase_order_no"
                                       class="form-control   @error('purchase_order_no') is-invalid @enderror"
                                       id="purchase_order_no"
                                       placeholder="Purchase Order Name" value="{{ old('purchase_order_no') }}">
                                @error('purchase_order_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="sup_id">Supplier</label>
                            <div class="col-sm-8">
                                <select required name="sup_id" id="sup_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Supplier</option>
                                    @foreach($suplier as $item)
                                        <option
                                            @selected($item->id == old('sup_id')) value="{{$item->id}}">{{$item->Sup_Name}}</option>
                                    @endforeach
                                </select>
                                @error('sup_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-1 text-center my-2">
                                <a href="{{route('supplier.create')}}" class="btn btn-xs btn-success"
                                   data-toggle="tooltip" data-placement="bottom" title="Add New Supplier"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="vote_id">Vote Code</label>
                            <div class="col-sm-9">
                                <select required required name="vote_id" id="vote_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Vote Code</option>
                                    @foreach($votes as $item)
                                        <option
                                            @selected($item->id == old('vote_id')) value="{{$item->id}}">{{$item->vote_code}}</option>
                                    @endforeach
                                </select>
                                @error('vote_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="rcvd_to">Received To</label>
                            <div class="col-sm-9">
                                <select required required name="rcvd_to" id="rcvd_to"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Received To</option>
                                    @foreach($establisments as $establisment)
                                        <option
                                            @selected($establisment->id == old('rcvd_to')) value="{{$establisment->id}}">{{$establisment->issue_place}}</option>
                                    @endforeach
                                </select>
                                @error('rcvd_to')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="amount">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" name="amount"
                                       class="form-control   @error('amount') is-invalid @enderror"
                                       id="amount"
                                       placeholder="Amount" value="{{ old('amount') }}">
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="p_order_remarks">Remarks</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="p_order_remarks"
                                          class="form-control   @error('p_order_remarks') is-invalid @enderror"
                                          id="p_order_remarks"
                                          placeholder="Remarks">{{old('p_order_remarks')}}</textarea>
                                @error('p_order_remarks')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugin/select2/css/select2.css') }}">
@stop

@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>
    <script src="{{ asset('plugin/select2/js/select2.min.js') }}" defer></script>
    <script>

        $(document).ready(function () {
            $("#sup_id").select2();
            $("#rcvd_to").select2();
            $("#vote_id").select2();
        });
    </script>
@stop
