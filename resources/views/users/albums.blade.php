@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <h4 class="mt-3"><i class="fas fa-images"></i> User albums <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @if (Session::has('message-remove-album'))
        <div class="alert alert-danger">{{ Session::get('message-remove-album') }}</div>
    @endif

    <div class="row mb-4" style="padding: 0 15px;">
        @if($user->albums->count() == 0)
            <h4>User has not added any album yet</h4>
        @else
            @foreach($user->albums as $album)
                @include('layouts.includes.album')
            @endforeach
        @endif
    </div>

@endsection