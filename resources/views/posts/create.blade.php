@extends('layouts.app')

@section('content')
    <div>
        <aside class=" main-sidebar sidebar-dark-primary elevation-4">

            <div class="fa-2x pl-3 font-weight-bold text-blue" style="color: #ffffff">
                <a href="/admin" class="text-decoration-none">
                    myApp
                </a>

            </div>

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
                            <a href="/post/create" class="nav-link active">
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


        <div class="container">
            <form action="/post" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <h1>Add New Post</h1>
                        </div>
                        <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>
                            <input id="caption"
                                   type="text"
                                   class="form-control @error('caption') is-invalid @enderror"
                                   name="caption"
                                   value="{{ old('caption') }}"
                                   autocomplete="caption" autofocus>
                            @error('caption')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label ">Post Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            @error('image')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="row pt-4">
                            <button class="btn btn-primary">Add New Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
