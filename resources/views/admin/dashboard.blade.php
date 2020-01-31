@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->username}}</td>
                        <td>
                            @if($user->active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.status', $user->username) }}" method="post">
                            @csrf
                            @method('patch')

                            @if($user->active)
                                <button name="block" class="btn btn-danger btn-sm">Block</button>
                            @else
                                <button name="unblock" class="btn btn-success btn-sm">Unblock</button>
                            @endif
                            </form>

                            <a href="{{ route('admin.user', $user->username) }}" class="btn btn-warning btn-sm">Backdoor</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>
</div>
@stop
