@extends('site.layout')

@section('title', 'انتخاب درگاه پرداخت')

@section('css')
    <style>
        .gateway-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        .gateway-card:hover {
            transform: translateY(-5px);
        }

        .gateway-input:checked+.gateway-card {
            border-color: #7477f2;
            box-shadow: 0 0 10px rgba(116, 119, 242, 0.4);
        }

        .gateway-radio {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-5">انتخاب روش پرداخت</h2>

        <form action="{{ route('user.subscript.payment') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 mb-4">
                    <label class="d-block">
                        <input type="radio" name="gateway" class="gateway-radio gateway-input" value="zarinpal" required>

                        <div class="card gateway-card text-center p-3 h-100 shadow-sm">
                            <div class="mb-3">
                                <img class="img-fluid" src="{{ asset('images/zarinpal.png') }}" alt="زرین پال"
                                    style="max-height: 50px">
                            </div>
                            <h5 class="text-dark">زرین پال</h5>
                        </div>
                    </label>
                </div>
                <div class="col-6 col-md-4 mb-4">
                    <label class="d-block">
                        <input type="radio" name="gateway" class="gateway-radio gateway-input" value="wallet" required>

                        <div class="card gateway-card text-center p-3 h-100 shadow-sm">
                            <div class="mb-3">
                                <img class="img-fluid" src="{{ asset('images/wallet.png') }}" alt="کیف پول"
                                    style="max-height: 50px">
                            </div>
                            <h5 class="text-dark">کیف پول</h5>
                        </div>
                    </label>
                </div>
            </div>
            <input type="hidden" name="subscription_id" value="{{ $subscription_id }}">
            <input type="hidden" name="status_payment" value="{{ $status_payment }}">

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-light">ادامه به پرداخت</button>
            </div>
        </form>
    </div>
@endsection
