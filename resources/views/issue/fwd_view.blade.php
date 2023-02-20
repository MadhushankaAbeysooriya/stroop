@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Issue Forward</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Issue</li>
                            <li class="breadcrumb-item active">Forward</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('issue.forward',$issue->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3">Item Code</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->items->Item_Code }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Item Name</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->items->Item_Type }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Ledger Number</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->items->Leger_No }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Manufactured Country</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->items->Make_Country }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Purchase Order No</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->purchase->purchase_order_no }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Issue Type</label>
                            <div class="col-sm-9">

                                @switch ($issue->Issued_Type)
                                    @case ('Q5')
                                        <h5><span class="badge badge-primary">Q5</span></h5>
                                        @break
                                    @case ('G2')
                                        <h5><span class="badge badge-primary">G2</span></h5>
                                        @break
                                    @case ('G4')
                                        <h5><span class="badge badge-primary">Temporary</span></h5>
                                        @break
                                    @case ('JC')
                                        <h5><span class="badge badge-primary">Job Card</span></h5>
                                        @break
                                    @default
                                        <h5><span class="badge badge-danger">error</span></h5>
                                        @break
                                @endswitch

                            </div>
                        </div>

                        @if ($issue->job_no != null)
                            <div class="form-group row">
                                <label class="col-sm-3">Job Number</label>
                                <div class="col-sm-9">
                                    <label>{{ $issue->job_no }}</label>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-sm-3">Quantity</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->quentity }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Serial Numbers</label>
                            <div class="col-sm-9">
                                @foreach ($ser_no as $item)
                                    <label>{{ $loop->iteration }}.{{ $item->Seri_No }}</label><br>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Issued Place</label>
                            <div class="col-sm-9">
                                <label>{{ $issue->issue_place->place_discription }}</label>
                            </div>
                        </div>

                        <div class="form-group row" id="issued_off_no">
                            <label class="col-sm-3" for="issued_off_no">Reg No</label>
                            <div class="col-sm-5">
                                <input type="text" name="issued_off_no"
                                       class="form-control   @error('issued_off_no') is-invalid @enderror"
                                       id="issued_off_no"
                                       placeholder="Reg No" value="{{ old('issued_off_no') }}">
                                @error('issued_off_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="issued_off_rank">Rank</label>
                            <div class="col-sm-5">
                                <select required name="issued_off_rank" id="issued_off_rank"
                                        class="form-control   @error('issued_off_rank') is-invalid @enderror">
                                    @foreach($rank as $item)
                                        <option
                                            @selected($item->rank_id == old('rank_id')) value="{{$item->rank_id}}">{{$item->rank_code}}</option>
                                    @endforeach
                                </select>
                                @error('issued_off_rank')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="issued_off_name">
                            <label class="col-sm-3" for="issued_off_name">Name</label>
                            <div class="col-sm-5">
                                <input type="text" name="issued_off_name"
                                       class="form-control   @error('issued_off_name') is-invalid @enderror"
                                       id="issued_off_name"
                                       placeholder="Name" value="{{ old('issued_off_name') }}">
                                @error('issued_off_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="issued_off_regiment">Establishment</label>
                            <div class="col-sm-5">
                                <select required name="issued_off_regiment" id="issued_off_regiment"
                                        class="form-control   @error('issued_off_regiment') is-invalid @enderror">
                                    @foreach($issuePlace as $item)
                                        <option
                                            @selected($item->id == old('id')) value="{{$item->id}}">{{$item->place_discription}}</option>
                                    @endforeach
                                </select>
                                @error('issued_off_regiment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="issued_off_remarks">Remarks</label>
                            <div class="col-sm-5">
                                <textarea type="text" name="issued_off_remarks"
                                          class="form-control   @error('issued_off_remarks') is-invalid @enderror"
                                          id="issued_off_remarks"
                                          placeholder="Remarks">{{old('issued_off_remarks')}}</textarea>
                                @error('issued_off_remarks')
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
            $("#issued_off_rank").select2();
            $("#issued_off_regiment").select2();
        });
    </script>

@stop
