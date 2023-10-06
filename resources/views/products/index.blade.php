@extends('products.layout')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="pull-left">
                <h2 class="mt-2">Laravel 9 CRUD with Image Upload </h2>
            </div>

            <div class="text-end mb-2">
                <a class="btn btn-primary" href="{{ route('products.create') }}"> + Create New Product </a>

                <a class="btn btn-success" href="{{ route('category.index') }}"> Add Category</a>
            </div>

            <table class="table table-bordered mt-3 datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Product Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.datatable').DataTable({
            ajax: "{{ route('products.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'detail',
                    name: 'detail'
                },
                {
                    data: 'cname',
                    name: 'cname'
                },
                {
                    data: 'image',
                    name: 'image'

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    serchable: false
                },
            ],
        });
    });
</script>