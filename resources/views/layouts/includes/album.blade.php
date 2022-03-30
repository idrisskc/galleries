<!-- single album -->
<div class="col-6 col-md-3 no-padding" style="padding:2px;">
    <a href="{{ url('/users/' . $user->id . '/albums/' . $album->id) }}">
        <div class="view overlay hm-blue-light">
            <img title="{{$album->title}}" class="img-fluid" src="{{url('storage/users') . '/' . $user->id . '/images/' . $album->primary_image }}" alt="">
            <div class="mask flex-center">
                <h5 class="white-text text-center mt-2">{{$album->title}}</h5>
            </div>
        </div>
    </a>
</div>