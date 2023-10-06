<!-- @extends('products.layout') -->

@section('content')


<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="pull-left">
                <h2 class="mt-2">Add Category Here</h2>
            </div>

            <div class="text-end mb-2">
                <a class="btn btn-primary" href="{{ route('category.create') }}">Add</a>

                <a class="btn  btn-warning" href="{{ route('products.index') }}">Back to Product List</a>
            </div>

            <table class="table table-bordered mt-2 datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created_at</th>
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
            ajax: "{{ route('category.index') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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