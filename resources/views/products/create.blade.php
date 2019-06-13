@extends('layouts.app')

@section('page-title' , 'Add New Test')

@section('page-content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-8 mr-auto ml-auto">
            <div class="text-center">
                <h1>Add New Test</h1>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Test Name:</label>
                    <input id="name" type="text" name="name" class="form-control" placeholder="Product Name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input id="price" type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
                </div>
                <!-- @inputfield product_category_id  -->
                <div class="form-group">
                    <label for="product_category_id">Select Category</label>
                    <select name="product_category_id" id="product_category_id" class="form-control select2">
                        <option value="null" selected>No category</option>
                        @foreach($product_cats as $product_cat)
                        <option value="{{ $product_cat->id }}">{{ $product_cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop