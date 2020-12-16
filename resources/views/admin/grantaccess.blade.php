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
                            <a href="/post/create" class="nav-link">
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/permission" class="nav-link active">
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
                            <button class="btn btn-primary" name="path" value="{{ 1 }}">Make Admin</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
