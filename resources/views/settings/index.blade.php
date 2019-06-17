@extends('layouts.app')

@section('page-title' , 'Settings')


@section('page-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="text">
                    <h3>Update Settings</h3>
                </div>

                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="text" name="password" id="password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@stop