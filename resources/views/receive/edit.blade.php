@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Supplier </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Supplier</li>
                            <li class="breadcrumb-item active">edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Supplier</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('supplier.update',$supplier->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="Sup_Name">Supplier Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="Sup_Name"
                                       class="form-control   @error('Sup_Name') is-invalid @enderror" id="Sup_Name"
                                       placeholder="Supplier Name" value="{{$supplier->Sup_Name}}">
                                @error('Sup_Name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Addrs">Address </label>
                            <div class="col-sm-9">
                                <textarea type="text" name="Addrs"
                                          class="form-control   @error('Addrs') is-invalid @enderror" id="Addrs"
                                          placeholder="Address">{{$supplier->Addrs}}</textarea>
                                @error('address')
                                <span Addrs="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Tel">Contact No</label>
                            <div class="col-sm-9">
                                <input type="text" name="Tel"
                                       class="form-control   @error('Tel') is-invalid @enderror" id="Tel"
                                       placeholder="Contact No" value="{{ $supplier->Tel}}">
                                @error('Tel')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Fax">Fax No</label>
                            <div class="col-sm-9">
                                <input type="text" name="Fax"
                                       class="form-control   @error('Fax') is-invalid @enderror" id="Fax"
                                       placeholder="Fax No" value="{{$supplier->Fax }}">
                                @error('Fax')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Email">Email</label>
                            <div class="col-sm-9">
                                <input type="Email" name="Email"
                                       class="form-control   @error('Email') is-invalid @enderror" id="Email"
                                       placeholder="Email" value="{{ $supplier->Email}}">
                                @error('Email')
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
@stop

@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
@stop
