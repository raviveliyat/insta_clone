@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row mt-4">
                <div class="col-md-2 offset-md-2">
                    <img class="img-thumbnail rounded-circle" src="{{ $profile->profile_pic_url }}" alt="{{ $profile->title }}">
                </div>
                <div class="col ml-4">
                    <h3>
                        {{ $user->username }}
                        <small>
                            @if($user->id === Auth::user()->id)
                                <a href="{{ route('p.create') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Create Post
                                </a>

                                <a href="{{ route('user.edit', $user->username) }}" class="btn btn-warning btn-sm" title="Edit Profile">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                            @else
                                <form action="{{ route('user.follow', $user->username) }}" method="post">
                                    @csrf
                                    @method('patch')

                                    @if($user->followers()->where(['follower_id' => auth()->user()->id, 'is_followed' => true ])->first())
                                        <button class="btn btn-link btn-sm">Unfollow</button>
                                    @else
                                        <button class="btn btn-primary btn-sm">Follow</button>
                                    @endif
                                </form>
                            @endif
                        </small>
                    </h3>

                    <div><strong>{{ $profile->title }}</strong></div>
                    <div>{{ $profile->description }}</div>
                    <a href="{{ $profile->website}}">{{ $profile->website }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <hr>
            <div class="row">
            @if($user->posts()->get()->toArray())
                @foreach($user->posts as $post)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('p.show', $post->id) }}">
                            <img class="img-thumbnail" src="{{ str_replace('storage/posts', 'storage/thumbnails/posts', $post->post_pic_url) }}" alt="{{ $post->title }}">
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-md-6">
                    <div class="alert alert-info">No Posts To Show</div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@stop
