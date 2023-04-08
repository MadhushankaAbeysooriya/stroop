@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Unit </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Items</li>
                            <li class="breadcrumb-item active">add unit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Units - {{ $item->Item_Type }}</div>
                    <div class="card-tools">
                        <a href="{{ route('item.add_unit_item_view') }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('item.add_unit',$item->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">                       

                        <!-- <div class="form-group row">
                            <label class="col-sm-3" for="name">Sub Units</label>
                            <div class="col-sm-8">
                                <input type="text" name="name"
                                       class="form-control   @error('name') is-invalid @enderror" id="name"
                                       placeholder="Unit Name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label class="col-sm-3" for="title_no">Item Sub Unit</label>
                            <div class="col-sm-8">                               
                                <select required name="title_no" id="title_no"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($items as $item)
                                        <option
                                            @selected($item->Item_Type == old('Item_Type')) value="{{$item->id}}">{{$item->Item_Type}}</option>
                                    @endforeach
                                </select>
                                @error('title_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Add
                        </button>
                    </div>
                </form>

                @if(!empty($item_units))
                    <div class="card">
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($item_units as $item_unit)
                                <tr>
                                    <td>{{ $item_unit->sub_item->Item_Type }}</td>
                                    <td><a href={{ route('item.add_unit_remove', ['id'=>$item_unit->id, 'item' => $item->id]) }} class="btn btn-xs btn-danger" 
                                        data-toggle="tooltip" data-placement="bottom" title="Item Details">
                                        <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>                            
                            @endforeach
                        </table>
                    </div>
                @endif
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
<script type="text/javascript">
    $(document).ready(function () {
                $('#title_no').select2().on('change', function (item) {
                    // var store_id = $('#store_id').val();
                    // var ict = $('#ict').val();
                    // var category_type = $('#category_type').val();
                    var title_no = $('#title_no').val();                    
                });                
            });
</script>
@stop
