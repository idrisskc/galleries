@extends('layouts.app')



@section('content')
    <style>
        .remove-images .image-checkbox-checked {
            border-color: red !important;
        }
    </style>

    <h4>Editing the album</h4>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <hr>

    <form action="{{url('/users/' . $user->id . '/albums/' . $album->id)}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}


        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group mt-2">
                    <label for="name" {{ $errors->has('name') ? ' data-error=wrong' : '' }} >Your title
                         album </label>
                    <input type="text" name="name" id="name"
                           class="form-control {{ $errors->has('name') ? ' validate invalid' : '' }}"
                           value="{{$album->title}}" placeholder="Tutaj podaj nazwę albumu">

                    @if ($errors->has('name'))
                        <span class="help-block">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group mt-0">
                    <label for="name" {{ $errors->has('name') ? ' data-error=wrong' : '' }} >Album description </label>
                    <textarea name="description" id="description"
                              class="form-control {{ $errors->has('description') ? ' validate invalid' : '' }}"
                              value="{{ old('name') }}" placeholder="Tutaj wpisz opis albumu">{{$album->description}}
                    </textarea>

                    @if ($errors->has('description'))
                        <span class="help-block">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="">Select the main photo for the album </label>
                    <input name="primary_image" type="file" class="form-control upload-input" placeholder="Wybierz zdjęcie główne" accept=".jpg,.jpeg" multiple>

                    @if ($errors->has('primaryImage'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('primaryImage') }}</strong>
                                            </span>
                    @endif

                </div>

                <p class="mb-0">The current photo: </p>
                <img  style="max-width:150px;" class="img-fluid mb-4" src="{{url('storage/users') . '/' . $album->user_id . '/images/' . $album->primary_image }}" alt="">

            </div>

        </div>


        <div class="mb-3">
            <a style="margin-left: -1px;" class="btn btn-danger" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
            Remove photos from album
            </a>
        </div>

        <div class="collapse" id="collapseExample2">
            <div class="mt-3">

                <div class="row">
                    <h4>Pictures in this album</h4><small>(select the photos you want to be deleted)</small>
                </div>

                <div class="row remove-images" style="padding:0 10px;">


            @foreach($album->images as $image)

                <div class="col-md-2 no-padding" style="padding:2px;">

                    <label class="image-checkbox">
                        <img class="img-responsive" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}" />
                        <input type="checkbox" name="remove_image[]" value="{{$image->id}}" />
                    </label>

                </div>

            @endforeach
        </div>


            </div></div>



        <div class="row">

            <div class="col-sm-12 col-sm-offset-1">

                <div class="mb-3">
                    <a style="margin-left: -1px;" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Add photos you've already uploaded
                    </a>
                </div>

                <div class="collapse" id="collapseExample">
                    <div class="mt-3">
                        <div class="row" style="padding:0 10px;">

                            @foreach(Auth::user()->images as $image)

                                <div class="col-md-2 no-padding" style="padding:2px;">

                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}" />
                                        <input type="checkbox" name="check_image[]" value="{{$image->id}}" />
                                    </label>

                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>


            </div>


        </div>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for=""> Or, select the photos you want to add as new  (.jpg) </label>
                    <input name="images[]" type="file" class="form-control upload-input" placeholder="Wybierz zdjęcia" accept=".jpg,.jpeg" multiple>

                    @if ($errors->has('primaryImage'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('primaryImage') }}</strong>
                                            </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-sm-offset-1">
                <label for="">If you want only certain users to see this album, select them in the list below
                    <br> <small>(if you leave all fields blank, the album will be visible to everyone by default)</small> </label>

                @foreach($users as $user)

                    @if( $user->hasRole('User') && $user->id != Auth::id())
                    <div class="col-md-2 no-padding" style="padding:2px;">

                        <label class="image-checkbox">
                            <span>{{$user->name}}</span>
                            <input type="checkbox" name="check_users[]" value="{{$user->id}}"
                                   @if (!empty($album->access_users))
                                        @if(in_array ( $user->id, json_decode($album->access_users))) checked @endif
                                    @endif
                            />
                        </label>

                    </div>
                    @endif

                @endforeach
            </div>
        </div>

        <div class="row mt-4" style="margin-left: -1px">
            <input style="margin-left: -1px"  type="submit" value="Zapisz album" class="btn btn-secondary pull-right">
        </div>



    </form>


    <script>
        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))

            e.preventDefault();
        });
    </script>

@endsection