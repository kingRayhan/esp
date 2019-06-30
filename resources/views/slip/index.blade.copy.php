@extends('layouts.app')

@section('page-title' , 'Payment Slips')

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
                <h2 class="text-uppercase pb-2">Payment Slips</h2>

                <table id="datatable" class="table table-hover">
                    <thead>
                    <tr>
                        <th>#ID</th>                        
                        <th>Time</th>                        
                        <th>Patient</th>                        
                        <th>Refered Doctor</th>                        
                        <th>Actions</th>                        
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($slips as $slip)
                            <tr>
                                <td>{{$slip->id}}</td>
                                <td>{{$slip->created_at}}</td>
                                <td>{{$slip->customer_name}}</td>
                                <td>
                                    @if ($slip->doctor)
                                    <a href="{{ route('doctors.show' , $slip->doctor->id ) }}">
                                        {{$slip->doctor['name']}}
                                    </a>
                                    @else
                                        No reference
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('slip.show' , $slip->id) }}">View Slip</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop