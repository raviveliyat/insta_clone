@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <img class="img-thumbnail" src="{{ $post->post_pic_url }}" alt="{{ $post->title }}">
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('user.profile', $post->user->username) }}">
                                <img width="20px" class="mr-2 rounded-circle" src="{{ $post->user->profile->profile_pic_url }}" alt="{{ $post->user->username }}">
                                <strong>{{ $post->user->username }}</strong>
                            </a>

                            @if($post->user->id === Auth::user()->id)
                                <form action="{{ route('p.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-link btn-sm text-danger">Delete Post</button>
                                </form>
                            @else
                                <a href="" class="btn btn-link btn-sm">Follow</a>
                            @endif
                        </div>
                        <div class="card-body">
                            <strong>{{ $post->title }}</strong>
                            <p>{{ $post->description }}</p>
                            <p>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
