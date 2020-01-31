@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Create/Edit Profile</h3>

            <form action="{{ route('user.save', $user->username) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" value="{{ $profile ? $profile->title : '' }}" id="title" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ $profile ? $profile->description : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="profilePic">Profile Pic</label>
                    <input type="file" id="profilePic" name="profilePic">

                    @if($profile)
                        <br />
                        <input type="hidden" name="profile_pic_url" value="{{ $profile->profile_pic_url }}">
                        <img src="{{ $profile->profile_pic_url }}" alt="{{ $profile->title }}" height="100px" />
                    @endif
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" value="{{ $profile ? $profile->website : '' }}" id="website" name="website" class="form-control">
                </div>

                <button class="btn btn-primary btn-lg">Save</button>
            </form>
        </div>
    </div>
</div>
@stop
