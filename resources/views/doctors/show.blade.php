@extends('layouts.app')

@section('page-title' , 'Edit Customer')

@section('page-content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto">
                <div class="text-center">
                    <h1>{{ $doctor->name }}</h1>
                    <a href="{{ route('doctors.edit' , $doctor->id ) }}"><b>[Edit]</b></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ route('shoppinghistory' , $doctor->id) }}"><b>[Refered Tests]</b></a>
                </div>
                <br>
                <table class="table">
                    <tr>
                        <td><b>Email:</b></td>
                        <td>{{ $doctor->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Phone Number:</b></td>
                        <td>{{ $doctor->number }}</td>
                    </tr>
                    <tr>
                        <td><b>Address:</b></td>
                        <td>{{ $doctor->address }}</td>
                    </tr>
                    <tr>
                        <td><b>Note:</b></td>
                        <td>{{ $doctor->note }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop