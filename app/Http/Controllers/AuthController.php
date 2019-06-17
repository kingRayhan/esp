<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function settings()
    {
        $user = \Auth::user();
        return view('settings.index', compact('user'));
    }
    public function updateSettings(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = \App\User::find(\Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return \Redirect::back();
    }
}
