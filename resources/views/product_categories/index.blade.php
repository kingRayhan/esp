@extends('layouts.app')

@section('page-title' , 'All Categories')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">


@stop
@section('footer')
    <script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": ['0' , 'desc']
            });
        } );
    </script>
@stop

@section('page-content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-uppercase pb-2">All Product Categories</h1>

                @if(Auth::user()->role === 'superadmin')
                <div class="pt-3 pb-5">
                    <a href="{{ route('product_categories.create')  }}" class="btn btn-primary">Add new</a>
                </div>
                @endif

                <table id="datatable" class="table table-hover">
                    <thead>
                    <tr>
                        <th>Category Name</th>
                        <td>Total Product</td>
                        @if(Auth::user()->role === 'superadmin')
                        <th>Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_cats as $product_cat)
                        <tr>
                            <td>
                                <a href="{{ route('product_category.products' , $product_cat->id) }}">
                                {{ $product_cat->name }}</a></td>
                            <td>{{ $product_cat->product->count() }}</td>
                            @if(Auth::user()->role === 'superadmin')
                            <td>
                                <a href="{{ route('product_categories.edit' , $product_cat->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <form action="{{ route('product_categories.destroy' , $product_cat->id) }}" method="POST" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button onclick="confirm('Are you sure to delete?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop