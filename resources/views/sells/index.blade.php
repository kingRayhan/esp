@extends('layouts.app')
@section('page-title' , 'Test Reports')
@section('header')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <style>
        .barcode-sticker {
            background: #FFF;
            padding: 8px;
            padding-bottom: 0;
        }

        .barcode-sticker img {
            max-width: 100%;
            width: 185px;
            height: 46px;
        }

        span.product-id {
            text-align: center;
            display: inherit;
            font-weight: bold;
            color: #000;
            font-size: 12px;
            letter-spacing: 8px;
        }
    </style>

@stop
@section('footer')
    <script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "order": ['0', 'desc'],
                pageLength: 49
            });
        });
    </script>
@stop

@section('page-content')
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h1 class="text-uppercase">Test Reports</h1>

                <test-report :sells="{{$sells->toJSON()}}" :totalsales="{{$total_sales}}"></test-report>
                <div class="d-flex align-items-center justify-content-center">

                    {{$sells->appends(request()->query())->links()}}
                </div>

            </div>
        </div>
    </div>
@stop