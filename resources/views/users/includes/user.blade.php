{{--@if (belongs_to_auth($user->id))--}}
    {{--<a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">add photos</a>--}}
    {{--<a href="{{url('/users/' . $user->id . '/albums/create')}}" class="btn btn-secondary">Add an album</a>--}}
{{--@endif--}}

{{--@hasrole('writer')--}}
    {{--<a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">add photos</a>--}}
    {{--<a href="{{url('/users/' . $user->id . '/albums/create')}}" class="btn btn-secondary">Add an album</a>--}}
{{--@endif--}}

<h2 class="mt-3 mb-4"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ $user->name }}</h2>