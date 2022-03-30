<!-- single image -->
@if(check_image_permission($image->id))
    <div class="col-6 col-md-3 no-padding"  style="padding:5px;">
        <div class="view hm-zoom">
            <a href="{{url('/users/' . $image->user->id . '/images/'. $image->id )}}"><img class="img-fluid" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}" alt=""></a>
        </div>
    </div>
@endif