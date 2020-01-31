<?php

namespace App\Http\Controllers;

use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        //TODO: Authentication and Authorization Middlewares to be used here.
        $this->middleware('auth.admin');
    }

    public function dashboard()
    {
        $users = User::where(['type' => 'user'])->paginate(5);
        // return view('admin.dashboard', compact('users'));
        return view('admin.dashboard')->with([
            'users' => $users,
        ]);
    }

    public function changeUserStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();
        return back();
    }

    public function userPortal(User $user)
    {
        auth()->login($user);
        return redirect(route('login'));
    }
}
