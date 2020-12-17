@extends('layouts.app')

@section('content')
    <div>
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-danger col-8 offset-2 ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ Session::get('message', '') }} </strong>
                </div>
            @endif
            <form action="/admin" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <h1>Grant Admin Permission</h1>
                        </div>
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label ">Id</label>
                            <input id="id"
                                   type="text"
                                   class="form-control @error('id') is-invalid @enderror"
                                   name="id"
                                   autocomplete="id" autofocus>
                            @error('id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label ">Name</label>
                            <input id="name"
                                   type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="row pt-4">
                            <button class="btn btn-primary">Make Admin</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
