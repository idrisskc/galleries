@extends('layouts.app')

@section('content')

    <div class="row mb-4">

        {{--<app id="app"--}}
             {{--:user="{{ auth()->user() }}"--}}
             {{--:permissions="{{ auth()->user()->permissions()->get() }}"--}}
        {{--></app>--}}
        {{--@if(Auth::check())--}}
        {{--<div class="table-responsive">--}}
            {{--<router-view name="companiesIndex"></router-view>--}}
            {{--<router-view></router-view>--}}
        {{--</div>--}}
        {{--@endif--}}


        {{--<Addtobasket></Addtobasket>--}}

            <ul id="gallery" class="list-unstyled row">

                @foreach($images as $image)

                    @include('layouts.includes.image')

                @endforeach

            </ul>


    </div>


    <div class="row justify-content-center">
    {{ $images->links() }}
    </div>


@endsection
