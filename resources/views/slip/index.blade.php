@extends('layouts.app')

@section('page-title' , 'Sell Reports')

@section('header')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
@stop


@section('page-content')

    <report :slips="{{$slips->toJSON()}}" :grandtotal="{{$grandTotal}}" :grandnetbill="{{$grandNetBill}}"
            :granddiscount="{{$grandDiscounts}}"></report>
    <div class="d-flex align-items-center justify-content-center mb-5">

        {{$slips->appends(request()->query())->links()}}
    </div>
@stop