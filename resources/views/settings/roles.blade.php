@extends('layouts.app')

@section('page-title' , 'Users')

@section('page-content')
    <div class="container pt-2">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-uppercase">User</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>UserId</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><span class="badge badge-primary">{{$user->role}}</span></td>
                        <td>
                    <a href="{{ route('settings.singleUser' , $user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                    
            </div>
        </div>
    </div>
@stop