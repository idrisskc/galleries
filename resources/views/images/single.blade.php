@extends('layouts.app')

@section('content')

    @include('images.includes.paginate')

    <div class="row single-img">

        <!-- Image -->
        <div class="col-md-8 no-padding image">
            <img class="img-fluid hm-red-light" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . $image->path }}">
        </div>

        <!-- Right Sidebar -->
        <div class="col-md-4 right-sidebar">

                <h5 class="mt-3">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a>
                </h5>

            <hr class="mb-2 mt-2">

            @if ($image->rating)
                @include('images.includes.rate')
            @endif

                @if($image->title)
                    <h5 class="mt-2 mb-0"><i class="fa fa-camera-retro" aria-hidden="true"></i> {{$image->title}} </h5>
                @endif


                    @if($image->description)
                        <p style="line-height: 16px;" class="mt-1"><small>{{$image->description}}</small></p>
                    @endif

                    @if ($image->comments)

                        Komentarze
                        <hr class="mt-1 mb-2">
                        @if($image->comments < 1)
                            Currently no comments
                        @endif
                        @include('images.includes.comments')
                    @endif
        </div>
    </div>

    <div class="img-permissions">
    @if($image->permission == 0)
        <p><small>* The author does not consent to distribution</small></p>
    @elseif($image->permission == 1)
        <p><small>* The author agrees to dissemination</small></p>
    @endif
        <p class="pull-right image-views" ><small>number of views: {{$image->views}}</small></p>
    </div>

@endsection