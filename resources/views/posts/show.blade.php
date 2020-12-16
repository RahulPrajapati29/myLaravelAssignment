@extends('layouts.userapp')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-8">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="font-weight-bold">
                                <h1>{{ $post->user->name }}</h1>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span>{{$post->caption}}</span>
                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
