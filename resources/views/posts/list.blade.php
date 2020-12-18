@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-8 offset-3">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title ">Post Details &nbsp</h3>
                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-dark ">Create Post</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Date</th>
                            <th>Caption</th>
                            <th>Update</th>
                            <th>Delete Post</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->user_id }}</td>
                                @php
                                    $username = DB::table('users')->where('id', $post->user_id)->pluck('name');
                                @endphp
                                <td>{{ $username[0]  }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->caption }}</td>
                                <td>
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary text-white text-decoration-none " role="button">
                                        <span class="ion-edit"></span>
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('post.destroy',$post->id) }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary"><span class="ion ion-trash-a"></span> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
