@extends('layouts.app')

@section('content')

<a href="{{route('admin.notifications.read.all')}}" class="btn btn-lg btn">Mark all as read</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Notification</th>
            <th>created at</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($unreadNotifications as $notification)
        <tr>
            <td>{{$notification->data['message']}}</td>
            <td>{{$notification->created_at->diffForHumans()}}</td>
            <td>
                <div class="btn-group">
                <a href="{{route('admin.notifications.read',['notification'=>$notification->id])}}" class="btn btn-sm btn-info">Mark as read</a>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">
                <div class="alert alert-warning">
                    there is no notifications available
                </div>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection