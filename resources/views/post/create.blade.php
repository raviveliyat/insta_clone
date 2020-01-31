@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h4>Add A Post</h4>
                <form action="{{ route('p.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" rows="5" class="form-control" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="postPic">Picture URL</label>
                        <input type="file" id="postPic" name="postPic">
                    </div>

                    <button class="btn btn-primary btn-lg">Add</button>
                </form>
            </div>

            <div class="col-md-2 text-center">
                <h3>OR</h3>
            </div>

            <div class="col">
                <h4>Upload Excel File</h4>
                <form action="{{ route('p.storePosts') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="file" name="posts">
                    </div>

                    <button class="btn btn-primary btn-lg">Upload</button>
                </form>
            </div>
        </div>
    </div>
@stop
