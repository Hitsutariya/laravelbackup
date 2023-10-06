@extends('products.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Category</h2>
        </div>
        <div class="pull-right text-end">
            <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12" id="form_result">
            <div class="form-group">
                <strong> Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Category Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> Status:</strong><br>
                @php
                $status = 1;
                @endphp
                <input type="radio" id="action1" name="status" value="0"  /> Active
                <br>
                <input type="radio" id="action2" name="status" value="1" /> InActive </br>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2 ">
            <button type="submit" class="btn btn-dark" name="action" id="action">Submit</button>
        </div>
    </div>

</form>

@endsection