@extends('layouts.app')

@section('page-title' , 'Edit Product')

@section('page-content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto">
                <div class="text-center">
                    <h1>Edit Product</h1>
                </div>
                <form action="{{ route('products.update' , $product) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input 
                            id="name"
                            type="text" 
                            name="name" 
                            class="form-control" 
                            placeholder="Product Name" 
                            value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input id="price" type="number" class="form-control" name="price" placeholder="Price" value="{{ $product->price }}">
                    </div>
                    <!-- @inputfield product_category_id  -->
                     <div class="form-group">
                         <label for="product_category_id">Select Category</label>
                         <select name="product_category_id" id="product_category_id" class="form-control select2">
                             <option value="null">No category</option>
                             @foreach($product_cats as $product_cat)
                                 <option value="{{ $product_cat->id }}" @if($product_cat->id === $cat_id) selected @endif>{{ $product_cat->name }}</option>
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