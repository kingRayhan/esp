@extends('layouts.app')

@section('page-title' , 'Sell Reports')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
@stop


@section('page-content')
    <report></report>
@stop