@extends('products.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right text-end">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12" id="form_result">
            <div class="form-group">
                <strong>Product Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Product Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="detail"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group dropdown">
                <strong>Category :</strong><br>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category">
                @foreach($category as $id => $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong alt="Image Preview">Image:</strong><br>
                <input type="file" name="image" class="form-control" placeholder="image">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2 ">
            <button type="submit" class="btn btn-dark" name="action" id="action">Submit</button>
        </div>
    </div>

</form>

@endsection

