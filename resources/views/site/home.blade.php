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

    @if (!auth()->user()->hasActiveSubscription())
        <div class="card-alert-subscribe">
            <p>شما در حال حاضر از اشتراک رایگان استفاده میکنید</p>
            <p>در حالت رایگان روزانه فقط ۳ عبارت را می توانید جستجو کرده و در هر بار جستجو فقط ۳ سکانس نمایش داده می شود!
            </p>
            <p>برای استفاده نامحدود می توانید اشتراک حرفه ای تهیه کنید</p>
            <a href="{{ route('user.subscript.plans') }}" class="btn btn-sm btn-primary mt-3">خرید اشتراک</a>
        </div>
    @endif

    {{-- <x-services-list /> --}}

    <x-banner-list />

@endsection
