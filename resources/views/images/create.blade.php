@extends('layouts.app')

@section('content')
    <h4>Adding new photos</h4>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form action="{{url('/users/' . $user->id . '/images/upload')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="">Select the photos you want to add (.jpg) </label>
                    <input name="images[]" type="file" class="form-control upload-input" placeholder="Wybierz zdjęcia" accept=".jpg,.jpeg" data-max-size="2048" multiple>

                    @if ($errors->has('images.*'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('images.*') }}</strong>
                                            </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <input type="submit" class="btn btn-secondary right">
            </div>
        </div>

    </form>

@endsection