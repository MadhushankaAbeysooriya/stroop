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
                        <a href="{{ route('item.add_unit') }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('item.add_unit',$item->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">                       

                        <div class="form-group row">
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
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
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
                                    <td>{{ $item_unit->name }}</td>
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
    
@stop

@section('third_party_scripts')
    
@stop
