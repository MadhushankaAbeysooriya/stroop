@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Receive Item </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Receive</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Receive Item</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('receive.store') }}" id="myForm"
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
                                {{-- <select required name="title_no" id="title_no"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($titles as $item)
                                        <option
                                            @selected($item->title_no == old('title_no')) value="{{$item->title_no}}">{{$item->title_name}}</option>
                                    @endforeach
                                </select> --}}
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
                            <label class="col-sm-3" for="quentity">Quantity</label>
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

                        <div id="error-message"></div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Item_Auto_Id">Add Serial Number</label>
                            <div class="col-sm-9">
                                <table class="table" id="dynamicTable">
                                    <tr>
                                        <th>Name</th>
                                        <th>Serial Number</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="addmore[0][name]" placeholder="Enter Name"
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
                            <label class="col-sm-3" for="rec_from">Received From & Date</label>
                            <div class="col-sm-6">
                                <select required name="rec_from" id="rec_from"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Purchase Received From</option>
                                    @foreach($recivePlace as $item)
                                        <option
                                            @selected($item->id == old('rec_from')) value="{{$item->id}}">{{$item->Rec_place}}</option>
                                    @endforeach
                                </select>
                                @error('rec_from')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input required datepicker datepicker-format="yyyy/mm/dd" type="text" id="Issu_date"
                                           name="Issu_date"
                                           value="{{ old('Issu_date') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                @error('Issu_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="warranty_act_date">Warranty Act /Tec Approved Date</label>
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
                                           id="warranty_act_date"
                                           name="warranty_act_date"
                                           value="{{ old('warranty_act_date') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                @error('warranty_act_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="price">Item Price (LKR)</label>
                            <div class="col-sm-9">
                                <input type="text" name="price"
                                       class="form-control   @error('price') is-invalid @enderror" id="price"
                                       placeholder="Price" value="{{ old('price') }}">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="warranty">Warranty Period</label>
                            <div class="col-sm-6">
                                <input type="text" name="warranty"
                                       class="form-control   @error('warranty') is-invalid @enderror" id="warranty"
                                       placeholder="Warranty Period" value="{{ old('warranty') }}">
                                @error('warranty')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <select required name="duration" id="duration"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1">Year(s)</option>
                                    <option value="2">Month(s)</option>
                                    <option value="3">Day(s)</option>
                                </select>
                                @error('duration')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="Issu_remarks">Remarks</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="Issu_remarks"
                                          class="form-control   @error('Issu_remarks') is-invalid @enderror"
                                          id="Issu_remarks"
                                          placeholder="Remarks">{{old('Issu_remarks')}}</textarea>
                                @error('Issu_remarks')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" id="submit-form"
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
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>
    <script src="{{ asset('plugin/select2/js/select2.min.js') }}" defer></script>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#quentity').on('keyup', function () {
                var qty = parseInt($(this).val()) || 0;
                $('#dynamicTable').find('tr:gt(0)').remove();
                for (var i = 0; i < qty; i++) {
                    $('#dynamicTable').append('<tr><td><input type="text" name="addmore[' + i + '][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][ser]" placeholder="Enter your Serial Number" class="form-control" /></td><td><button type="submit" class="remove-tr text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-700 dark:border-red-700">Remove </button></td></tr>');
                }
            });

            // Validate each 'ser' input field on submit
            $(document).on('submit', '#myForm', function (e) {
                var qty = parseInt($('#quentity').val()) || 0;
                var valid = true;
                for (var j = 0; j < qty; j++) {
                    var inputField = $('input[name="addmore[' + j + '][ser]"]');
                    if (inputField.val() === '') {
                        valid = false;
                        break;
                    }
                }

                if (!valid) {
                    e.preventDefault();
                    alert('Serial Number cannot be empty.');
                    return false;
                }
            });
        });

        var i = 0;

        $("#add").click(function () {
            //console.log('in');
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][ser]" placeholder="Enter your Serial Number" class="form-control" /></td><td>' +
                '<button type="submit" class="  remove-tr text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-700 dark:border-red-700">Remove </button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });

    </script>

    <script>

        $(document).ready(function () {
            $("#title_no").select2();
        });

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
                        $('#Item_Auto_Id').append(new Option(value.Item_Code + ' - ' + value.Item_Type, value.id));
                    });
                }
            });
        })

    </script>
@stop
