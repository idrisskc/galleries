@extends('layouts.app')

@section('content')
    <div class='col-lg-12'>
        <h1 class="text-center">404</h1>
        <h3 class="text-center">
            page does not exist
        </h3>

        <p class="text-center">
            <a class="text-center" href="{{url('/')}}">Home</a>
        </p>
    </div>

@endsection