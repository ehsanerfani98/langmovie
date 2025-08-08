@extends('site.layout')
@section('title', 'خانه')

@section('content')

    @session('success')
        <div class="alert alert-success text-center" role="alert">
            {{ $value }}
        </div>
    @endsession

    @session('error')
        <div class="alert alert-danger text-center" role="alert">
            {{ $value }}
        </div>
    @endsession



    <x-sliders-list />

    <x-search-movie />

    {{-- <x-services-list /> --}}

    <x-banner-list />

@endsection
