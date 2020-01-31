<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function follow(User $user)
    {
        $follower = Follower::where([
            'user_id' => $user->id,
            'follower_id' => auth()->user()->id,
        ])->first();

        if($follower) {
            $follower->is_followed = !$follower->is_followed;
            $follower->save();
        } else {
            Follower::create([
                'user_id' => $user->id,
                'follower_id' => auth()->user()->id,
            ]);
        }

        return back();
    }

    public function profile(User $user)
    {
        $profile = $user->profile;
        return view('user.profile', compact('profile', 'user'));
    }

    public function editProfile(User $user)
    {
        $profile = $user->profile;

        return view('user.edit', compact('user', 'profile'));
    }

    public function saveProfile(User $user, Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'profilePic' => ['image'],
            'website' => ['required', 'url'],
        ]);

        if (isset($data['profilePic'])) {
            $path = $data['profilePic']->store('users', 'public');
            $data['profile_pic_url'] = config('app.storage_url') . '/' . $path;
        } else if ($request->profile_pic_url) {
            $data['profile_pic_url'] = $request->profile_pic_url;
        } else {
            $data['profile_pic_url'] = 'https://image.shutterstock.com/image-vector/avatar-man-icon-profile-placeholder-260nw-1229859850.jpg';
        }

        unset($data['profilePic']);

        if ($user->profile) {
            //TODO: update operation on profile
            $user->profile()->update($data);
        } else {
            $user->profile()->create($data);
        }

        return back();
    }
}
