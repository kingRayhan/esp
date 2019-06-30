@extends('layouts.app')

@section('page-title' , 'Payment Slips')

@section('header')

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">


@stop
@section('footer')
    {{-- <script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": ['0' , 'desc']
            });
        } );
    </script> --}}
@stop

@section('page-content')
    <report></report>
@stop