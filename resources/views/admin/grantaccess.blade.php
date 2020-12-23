@extends('layouts.app')

@section('content')
    <div>
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success col-8 offset-2 ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ Session::get('message', '') }} </strong>
                </div>
            @elseif(!Session::has('success') and Session::has('message'))
                <div class="alert alert-danger col-8 offset-2 ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{ Session::get('message', '') }} </strong>
                </div>
            @endif
            <form action="{{ route('permission.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group offset-2">
                    <div class="col-md-8">
                        <h1><label for="dropdown">Grant Admin Permission</label></h1><br>
                        <label for="id">Select Name:</label>
                        <select class="form-control" id="id" name="id">
                            @foreach($items as $item)
                                <option  value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('dropdown'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dropdown') }}</strong>
                            </span>
                        @endif
                        <br>
                        <button class="btn btn-primary">Make Admin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
