@if(Auth::check())

    <form id="rate-form-1" action="{{ url('images/' . $image->id . '/rate') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="rate_value" value="1">
    </form>
    <form id="rate-form-2" action="{{ url('images/' . $image->id . '/rate') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="rate_value" value="2">
    </form>
    <form id="rate-form-3" action="{{ url('images/' . $image->id . '/rate') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="rate_value" value="3">
    </form>
    <form id="rate-form-4" action="{{ url('images/' . $image->id . '/rate') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="rate_value" value="4">
    </form>
    <form id="rate-form-5" action="{{ url('images/' . $image->id . '/rate') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="rate_value" value="5">
    </form>


    @if(!getUserRateImage($image->id))
        <div class="star-rating">
            <span title="Oceń na 1" class="fa fa-star-o" onclick="event.preventDefault(); document.getElementById('rate-form-1').submit();"></span>
            <span title="Oceń na 2" class="fa fa-star-o" onclick="event.preventDefault(); document.getElementById('rate-form-2').submit();"></span>
            <span title="Oceń na 3" class="fa fa-star-o" onclick="event.preventDefault(); document.getElementById('rate-form-3').submit();"></span>
            <span title="Oceń na 4" class="fa fa-star-o" onclick="event.preventDefault(); document.getElementById('rate-form-4').submit();"></span>
            <span title="Oceń na 5" class="fa fa-star-o" onclick="event.preventDefault(); document.getElementById('rate-form-5').submit();"></span>
            <input type="hidden" name="whatever1" class="rating-value" value="2.56">
        </div>
    @else
        <small>Your rating is: {{getUserRateImage($image->id)->rating}}</small>
    @endif

@endif

<p class="mb-0">
    <small>Average rating of the photo is:</small>
    <span class="badge badge-primary">{{round($image->avgRating(), 2)}}</span>
</p>