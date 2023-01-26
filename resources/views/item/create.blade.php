@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Item </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Items</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Item</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('item.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="store_id">Relevent Stores</label>
                            <div class="col-sm-9">
                                <select required name="store_id" id="store_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Relevent Store</option>
                                    @foreach($stores as $store)
                                        <option
                                            @selected($store->id == old('store_id')) value="{{$store->id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="ict">ICT Category </label>
                            <div class="col-sm-9">
                                <select required name="ict" id="ict"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a ICT Category</option>
                                    @foreach($icts as $item)
                                        <option
                                            @selected($item->id == old('ict')) value="{{$item->id}}">{{$item->Category_Name}}</option>
                                    @endforeach
                                </select>
                                @error('ict')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="category_type">Equipment Type </label>
                            <div class="col-sm-9">
                                <select required name="category_type" id="category_type"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Equipment Type</option>
                                    @foreach($equipments as $item)
                                        <option
                                            @selected($item->id == old('category_type')) value="{{$item->id}}">{{$item->Type_Name}}</option>
                                    @endforeach
                                </select>
                                @error('category_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="title_no">Title Name</label>
                            <div class="col-sm-9">
                                <select required name="title_no" id="title_no"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Title</option>
                                    @foreach($titles as $item)
                                        <option
                                            @selected($item->id == old('title_no')) value="{{$item->id}}">{{$item->title_name}}</option>
                                    @endforeach
                                </select>
                                @error('title_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Item_Type">Item Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="Item_Type"
                                       class="form-control   @error('Item_Type') is-invalid @enderror" id="Item_Type"
                                       placeholder="Name" value="{{ old('Item_Type') }}">
                                @error('Item_Type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Leger_No">Leger Card No</label>
                            <div class="col-sm-8">
                                <input type="text" name="Leger_No"
                                       class="form-control   @error('Leger_No') is-invalid @enderror" id="Leger_No"
                                       placeholder="Leger Card No" value="{{ old('Leger_No') }}">
                                @error('Leger_No')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Make_Country">Manufactured Country </label>
                            <div class="col-sm-8">
                                <input type="text" name="Make_Country"
                                       class="form-control   @error('Make_Country') is-invalid @enderror"
                                       id="Make_Country"
                                       placeholder="Manufactured Country" value="{{ old('Make_Country') }}">
                                @error('Make_Country')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="is_serial">Serial Number Available..? </label>
                            <div class="col-sm-9">
                                <label class="inline-flex relative items-center mb-4 cursor-pointer">
                                    @if(old('is_serial'))
                                        <input checked type="checkbox" name="is_serial" value="1"
                                               class="sr-only peer">
                                    @else
                                        <input type="checkbox" name="is_serial" value="1"
                                               class="sr-only peer">
                                    @endif
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                                @error('is_serial')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Unit_Of_Issue">Unit Of Issues</label>
                            <div class="col-sm-9">
                                <select required name="Unit_Of_Issue" id="Unit_Of_Issue"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Unit Of Issues</option>
                                    @foreach($mesures as $item)
                                        <option
                                            @selected($item->id == old('Unit_Of_Issue')) value="{{$item->id}}">{{$item->measu_name}}</option>
                                    @endforeach
                                </select>
                                @error('Unit_Of_Issue')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="reorder">Re-Order Level</label>
                            <div class="col-sm-8">
                                <input type="text" name="reorder"
                                       class="form-control   @error('reorder') is-invalid @enderror" id="reorder"
                                       placeholder="Re-Order Level" value="{{ old('reorder') }}">
                                @error('reorder')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="comreserve">Commander Reserve </label>
                            <div class="col-sm-8">
                                <input type="text" name="comreserve"
                                       class="form-control   @error('comreserve') is-invalid @enderror" id="comreserve"
                                       placeholder="Commander Reserve" value="{{ old('comreserve') }}">
                                @error('comreserve')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Item_Remarks">Remarks</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="Item_Remarks"
                                          class="form-control   @error('Item_Remarks') is-invalid @enderror"
                                          id="Item_Remarks"
                                          placeholder="Remarks">{{old('Item_Remarks')}}</textarea>
                                @error('Item_Remarks')
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
