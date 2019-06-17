<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function settings()
    {
        $user = \Auth::user();
        return view('settings.index', compact('user'));
    }
    public function updateMe(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = User::find(\Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return \Redirect::back();
    }
    public function roles()
    {
        $users = User::all();
        return view('settings.roles', compact('users'));
    }

    public function singleUser(User $user)
    {
        return view('settings.edit', compact('user'));
    }
    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = User::find($request->userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;


        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return \Redirect::back();
    }
}
