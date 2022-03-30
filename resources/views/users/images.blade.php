@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <h4 class="mt-3"><i class="fa fa-image"></i> User photos <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="" style="padding: 0 15px;">

        <script>
            window.Laravel = <?php echo json_encode([
                'csrt_token' => csrf_token(),
                'user_id' => Auth::id(),
                'author_id' => $user->id,
                'users' => $users,
            ]); ?>
        </script>

        <router-view :user="{{$user->id}}" name="imagesIndex"></router-view>
        <router-view></router-view>

    </div>
@endsection