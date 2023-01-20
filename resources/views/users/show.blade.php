@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $user->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $user->name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View User</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$user->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">User Name</label>
                        <div class="col-sm-9">
                            <span>{{$user->username}}</span>
                        </div>
                    </div>

                    

                    <div class="form-group row">
                        <label class="col-sm-3" for="email">Email</label>
                        <div class="col-sm-9">
                            <span>{{$user->email}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="rank">Rank</label>
                        <div class="col-sm-9">
                            <span>{{$user->rank}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="reg_no">Registration NO</label>
                        <div class="col-sm-9">
                            <span>{{$user->reg_no}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="establishment_id">Establishment</label>
                        <div class="col-sm-9">
                            <span>{{$user->establishment->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Role</label>
                        <div class="col-sm-5 input-group">
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection


@section('third_party_stylesheets')
@stop

