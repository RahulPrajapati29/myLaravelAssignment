@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success col-8 offset-3 ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Success!</strong> {{ Session::get('message', '') }}
        </div>
    @endif
    <aside class=" main-sidebar sidebar-dark-primary elevation-4">

        <div class="fa-2x pl-3 font-weight-bold " style="color: #ffffff">myApp</div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a class= href="#" class="d-block">Admin: {{ $user->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link">
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/post/create" class="nav-link">
                            <p>
                                Posts
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/permission" class="nav-link">
                            <p>
                                Permissions
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="row">
        <div class="col-8 offset-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post Details</h3>
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
                                    <form action="/admin/{{ $loop->index }}/edit" enctype="multipart/form-data" method="GET">
                                        @csrf
                                        <button class="btn btn-primary" >Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/admin/{{ $loop->index }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary">Delete</button>
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
