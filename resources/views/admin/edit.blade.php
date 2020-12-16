@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/admin/{{ $pos }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Post</h1>
                    </div>

                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label ">Caption</label>
                        <input id="caption"
                               type="text"
                               class="form-control @error('caption') is-invalid @enderror"
                               name="caption"
                               value="{{ old('caption') ?? $post[$pos]->caption }}"
                               autocomplete="caption" autofocus>
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label ">Profile Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="row pt-4">
                        <button class="btn btn-primary" name="path" value="{{ $pos }}">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
