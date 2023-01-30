@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Issue Item </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Issue</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Issue Item</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('issue.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="store_id">Relevent Stores</label>
                            <div class="col-sm-9">
                                <select required name="store_id" id="store_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                                    @foreach($titles as $item)
                                        <option
                                            @selected($item->title_no == old('title_no')) value="{{$item->title_no}}">{{$item->title_name}}</option>
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
                            <label class="col-sm-3" for="Item_Auto_Id">Item Code</label>
                            <div class="col-sm-9">
                                <select required name="Item_Auto_Id" id="Item_Auto_Id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Item Code</option>
                                </select>
                                @error('Item_Auto_Id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Item_Auto_Id">Add Serial Number</label>
                            <div class="col-sm-9">
                                <table class="table" id="dynamicTable">
                                    <tr>
                                        <th>Name</th>
                                        <th>Serial Number</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="addmore[0][name]" placeholder="Enter your Name"
                                                   class="form-control"/></td>
                                        <td><input type="text" name="addmore[0][ser]"
                                                   placeholder="Enter your Serial Number"
                                                   class="form-control"/></td>
                                        <td>
                                            <button type="button" name="add" id="add"
                                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                                Add More
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="quentity">Quentity</label>
                            <div class="col-sm-9">
                                <input type="text" name="quentity"
                                       class="form-control   @error('quentity') is-invalid @enderror" id="quentity"
                                       placeholder="Quentity" value="{{ old('quentity') }}">
                                @error('quentity')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Voucher_No">Purchase Order No</label>
                            <div class="col-sm-9">
                                <select required name="Voucher_No" id="Voucher_No"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Purchase Order No</option>
                                    @foreach($purchase as $item)
                                        <option
                                            @selected($item->id == old('Voucher_No')) value="{{$item->id}}">{{$item->purchase_order_no}}</option>
                                    @endforeach
                                </select>
                                @error('Voucher_No')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="warranty_act_date">Assigned Date</label>
                            <div class="col-sm-9">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input required datepicker datepicker-format="yyyy/mm/dd" type="text"
                                           id="issue_date"
                                           name="issue_date"
                                           value="{{ old('issue_date') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                @error('issue_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="issued_place_id">Issue Place</label>
                            <div class="col-sm-9">
                                <select required name="issued_place_id" id="issued_place_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($issuePlace as $item)
                                        <option
                                            @selected($item->id == old('id')) value="{{$item->id}}">{{$item->issue_place}}</option>
                                    @endforeach
                                </select>
                                @error('issued_place_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Issued_Type">Issuing Type</label>
                            <div class="col-sm-9">
                                <select required name="Issued_Type" id="Issued_Type"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="Q5">Q5</option>
                                    <option value="G2">G2</option>
                                    <option value="G4">G4 (Temporary)</option>
                                    <option value="JC">Job Card</option>
                                </select>
                                @error('Issued_Type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="card_number">Job Card Number (If Required)</label>
                            <div class="col-sm-9">
                                <input type="text" name="card_number"
                                       class="form-control   @error('card_number') is-invalid @enderror" id="card_number"
                                       placeholder="Job Card Number" value="{{ old('card_number') }}">
                                @error('card_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="issu_sig_unit">Signal Unit</label>
                            <div class="col-sm-9">
                                <select required name="issu_sig_unit" id="issu_sig_unit"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($sigUnit as $item)
                                        <option
                                            @selected($item->id == old('id')) value="{{$item->id}}">{{$item->sig_unit_name}}</option>
                                    @endforeach
                                </select>
                                @error('issu_sig_unit')
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
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>

    <script type="text/javascript">

        var i = 0;

        $("#add").click(function () {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][ser]" placeholder="Enter your Serial Number" class="form-control" /></td><td>' +
                '<button type="submit" class="  remove-tr text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-700 dark:border-red-700">Remove </button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });

    </script>

    <script>

        $('#store_id').change(function () {
            var store_id = $('#store_id').val();

            $.ajax({
                url: '{{ route('ajax.getTitle') }}',
                type: 'get',
                data: {
                    'store_id': store_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#title_no option').remove();
                    $.each(response, function (key, value) {
                        $('#title_no').append(new Option(value.title_name, value.title_no));
                    });
                }
            });
        })

        $('#store_id').ready(function () {
            var store_id = $('#store_id').val();

            $.ajax({
                url: '{{ route('ajax.getTitle') }}',
                type: 'get',
                data: {
                    'store_id': store_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#title_no option').remove();
                    $.each(response, function (key, value) {
                        $('#title_no').append(new Option(value.title_name, value.title_no));
                    });
                }
            });
        })

        $("#store_id,#ict,#category_type,#title_no").change(function () {
            var store_id = $('#store_id').val();
            var ict = $('#ict').val();
            var category_type = $('#category_type').val();
            var title_no = $('#title_no').val();

            $.ajax({
                url: '{{ route('ajax.getItemCode') }}',
                type: 'get',
                data: {
                    'store_id': store_id,
                    'ict': ict,
                    'category_type': category_type,
                    'title_no': title_no,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#Item_Auto_Id option').remove();
                    $('#Item_Auto_Id').append(new Option('Choose a Item Code', ""));
                    $.each(response, function (key, value) {
                        $('#Item_Auto_Id').append(new Option(value.Item_Code, value.id));
                    });
                }
            });
        })

    </script>
@stop
