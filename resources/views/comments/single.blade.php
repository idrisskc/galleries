<div class="row" style="margin-bottom:15px;">
    <div class="col-md-12">

        <form action="{{ url('/comments') }}" method="POST">
            {{ csrf_field()  }}
            <div style="margin:0" class="form-group{{ $errors->has('image_' . $image->id .'_comment_content') ? ' has-error' : '' }}">


                <div class="row">

                    <div class="col-md-1" style="padding-right: 0; margin-top:6px;">
                        <img alt="Profil" title="Profil" style="padding:1px;" class="img-responsive img-circle" src="{{ url('images/user-avatar/' . Auth::id()) . '/65' }}" alt="">
                    </div>

                    <div class="col-md-11" style="padding-left: 5px;">
                        <input class="form-control" value="{{ old('image_' . $image->id .'_comment_content') }}" placeholder="Napisz komentarz..." name="image_{{ $image->id }}_comment_content" style="width: 100%; margin-top: 5px; border-radius: 15px;" name="" id="" rows="1">
                    </div>

                </div>

                <script>
                    $(document).ready(function() {
                        $('.submit_on_enter').keydown(function(event) {
                            // enter has keyCode = 13, change it if you want to use another button
                            if (event.keyCode == 13) {
                                this.form.submit();
                                return false;
                            }
                        });
                    });
                </script>

                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <input style="margin-top:10px; display:none " type="submit" class="submit_on_enter btn btn-primary pull-right" value="Dodaj komentarz">
                @if ($errors->has('image_' . $image->id .'_comment_content'))
                    <span class="help-block">
                <strong>{{ $errors->first('image_' . $image->id .'_comment_content') }}</strong>
            </span>
                @endif
            </div>
        </form>
    </div>
</div>