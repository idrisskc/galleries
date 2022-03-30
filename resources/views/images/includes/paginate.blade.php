<div class="images-controls">
    <div class="next-btn" >
        <a href="{{url('/users/' . $user->id . '/images/' . $image->id . '/prev')}}">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </div>
    <div class="prev-btn" >
        <a href="{{url('/users/' . $user->id . '/images/' . $image->id . '/next')}}">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
    </div>
</div>