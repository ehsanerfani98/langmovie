@extends('site.layout')

@section('title', 'خرید اشتراک')

@section('css')
    <style>
        span.price {
            background: #ff6cb0;
            padding: 4px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            margin: 10px 0 0;
            display: block;
            color: white;
        }

        span.duration {
            background: #fb36a2;
            padding: 4px;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            display: block;
            color: white;
        }
    </style>
@endsection
@section('content')
    @session('error')
        <div class="alert alert-danger text-center p-2" role="alert" style="font-size: 14px">
            {{ $value }}
        </div>
    @endsession
    @session('error2')
        <div class="alert alert-light p-2" role="alert" style="font-size: 14px">
            {!! $value !!}
        </div>
    @endsession
    @if (auth()->user()->hasActiveSubscription() && !$status_payment)
        <div class="alert alert-light text-center p-2" style="font-size: 14px">
            <p class="m-0 text-danger">شما یک اشتراک فعال دارید.</p>
            <p class="m-0">برای خرید اشتراک جدید باید اشتراک فعلی خود را <span class="text-danger">منقضی</span> کنید.</p>
            <p class="m-0">برای منقضی کردن اشتراک فعلی خود <a href="{{ route('user.subscriptions') }}">اینجا</a> کلیک کنید.
            </p>
        </div>
        <div class="card">
            <img class="img-fluid" src="{{ asset('images/help2.png') }}">
        </div>
    @else
        <div class="container py-3">
            <h5 class="text-center mb-4 color-primary">انتخاب اشتراک عضویت</h5>
            <div class="row">
                @foreach ($subscriptions as $subscription)
                    <div class="col-6 col-md-4 mb-2 px-1">
                        <form action="{{ route('user.subscript.select', ['subscription_id' => $subscription->id]) }}"
                            method="POST" class="card shadow-sm h-100 border-0">
                            @csrf
                            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                            <div class="card-body text-center py-2">
                                <div class="mb-2">
                                    <div class="icon">
                                        {!! $subscription->icon !!}
                                    </div>
                                </div>
                                <h5 class="card-title">{{ $subscription->name }}</h5>
                                <p class="card-text text-muted text-plan">
                                    <span class="price">{{ number_format($subscription->price) }} ریال <br></span>
                                    <span class="duration"> مدت: {{ $subscription->duration_days }} روز</span>

                                    {{-- <span class="price"> جستجوی روزانه : {{ $subscription->daily_search_limit }}</span>
                                    <span class="duration"> نمایش سکانس :
                                        {{ $subscription->daily_segment_limit }}</span> --}}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent text-center border-0">
                                <button type="submit" class="btn btn-sm btn-light w-100">پرداخت</button>
                            </div>
                            <input type="hidden" name="status_payment" value="{{ $status_payment }}">
                        </form>
                    </div>
                @endforeach
            </div>

            @if ($subscriptions->isEmpty())
                <div class="text-center text-muted mt-5">
                    اشتراکی یافت نشد.
                </div>
            @endif
        </div>
    @endif
@endsection
