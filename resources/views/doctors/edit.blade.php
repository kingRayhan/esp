@extends('layouts.app')

@section('page-title' , 'Edit Customer')

@section('page-content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto">
                <div class="text-center">
                    <h1>Edit Customer</h1>
                    <a href="{{ route('doctors.show' , $doctor->id) }}"><b>[Customer Details]</b></a>
                </div>
                <form action="{{ route('doctors.update' , $doctor->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                            <label for="name">Name:</label>
                            <input 
                                id="name"
                                type="text" 
                                name="name" 
                                class="form-control" 
                                placeholder="Name"
                                value="{{ $doctor->name }}"
                                >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input 
                                id="email"
                                type="text" 
                                class="form-control" 
                                name="email" 
                                placeholder="Email"
                                value="{{ $doctor->email }}"
                                >
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input 
                            id="phone_number"
                            type="text" 
                            class="form-control" 
                            name="number" 
                            placeholder="Phone Number"
                            value="{{ $doctor->number }}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea 
                            id="address"
                            class="form-control" 
                            name="address" 
                        >{{ $doctor->address }}</textarea>
                        <div class="form-group">
                            <label for="note">Note:</label>
                            <textarea 
                            id="note"
                            class="form-control" 
                            name="note" 
                        >{{ $doctor->note }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@stop