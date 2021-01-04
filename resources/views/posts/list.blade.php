@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="offset-2">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title ">Post Details &nbsp</h3>
                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-dark ">Create Post</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="laravel_datatable">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Caption</th>
                            <th>Created At</th>
                            <th>Edit Post</th>
                            <th>Delete Post</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        var SITEURL = "{{ route('post.list') }}";
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: SITEURL,
                    type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'caption', name: 'caption' },
                    {data: 'created_at', name: 'created_at' },
                    {data: 'edit', name: 'edit', orderable: false},
                    {data: 'delete', name: 'delete', orderable: false}
                ],
            });
        });
    </script>

@endpush
