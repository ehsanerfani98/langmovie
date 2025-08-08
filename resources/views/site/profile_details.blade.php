@extends('site.layout')
@section('title', 'جزئیات پروفایل')

@section('css')
    <style>
        .card-profile {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        .card-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .doc-status {
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 6px;
            font-weight: 500;
        }

        .verified {
            background-color: #e6f7ee;
            color: #10b759;
        }

        .not-verified {
            background-color: #fde8e8;
            color: #f04438;
        }

        .correction {
            background-color: #fff4e5;
            color: #ff9900;
        }

        .file-preview {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            padding: 4px;
            background: #fafafa;
        }

        .file-preview+.file-preview {
            margin-top: 12px;
        }

        .confirm-mobile {
            padding: 5px 10px;
            background: #f0fff7;
            width: fit-content;
            border-radius: 6px;
            gap: 8px;
        }

        .confirm-document {
            padding: 5px 10px;
            background: #ffffff;
            width: fit-content;
            border-radius: 6px;
            gap: 8px;
        }

        .confirm-mobile .title {
            color: #10b96c;
        }

        .fs-info {
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">



            <div class="row mb-2">
                <div class="col-md-7">
                    <p class="text-muted small mb-1 d-flex align-items-center confirm-mobile">
                        <span class="title">شماره موبایل احراز هویت ‌شده : {{ $user->phone }}</span>
                        <i class="bi bi-patch-check-fill ms-1" style="color: #10b96c; font-size: 16px;" title="تایید شده"></i>
                    </p>
                </div>
                <div class="col-md-5 d-flex justify-content-md-end justify-content-start">
                    <p class="text-muted small mb-1 d-flex align-items-center confirm-document">
                        <span class="title">وضعیت مدارک</span>
                        <span
                            class="doc-status {{ $user->document->is_verified ? 'verified' : ($user->document->needs_correction ? 'correction' : 'not-verified') }}">
                            {{ $user->document->is_verified ? 'تایید شده' : ($user->document->needs_correction ? 'نیازمند اصلاح' : 'در انتظار بررسی') }}
                        </span>
                    </p>
                </div>
            </div>


            @if ($user->document)
                <div class="card card-profile">
                    <div class="card-body">
                        <h6 class="mb-3">اطلاعات هویتی</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-muted small mb-1">نوع کاربری</p>
                                <p class="fw-semibold fs-info">{{ $user->document->type == 'real' ? 'حقیقی' : 'حقوقی' }}</p>
                            </div>

                            @if ($user->document->type == 'real')
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">نام</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->first_name }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">نام خانوادگی</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->last_name }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">کد ملی</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->national_id }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">موبایل</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->mobile }}</p>
                                </div>
                            @else
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">نام</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->first_name }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">نام خانوادگی</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->last_name }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">کد ملی</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->national_id }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">موبایل</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->mobile }}</p>
                                </div>
                                <div class="col-6 col-md-4 ">
                                    <p class="text-muted small mb-1">نام شرکت</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->company_name }}</p>
                                </div>
                                <div class="col-6 col-md-8 ">
                                    <p class="text-muted small mb-1">آدرس شرکت</p>
                                    <p class="fw-semibold fs-info">{{ $user->document->company_address }}</p>
                                </div>
                            @endif

                        </div>

                        @if ($user->document->description)
                            <div class="mt-3">
                                <p class="text-muted small mb-1">توضیحات</p>
                                <p>{{ $user->document->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($user->document->files->isNotEmpty())
                    <div class="card card-profile">
                        <div class="card-body">
                            <h6 class="mb-3">مدارک ارسال شده</h6>
                            <div class="row">
                                @foreach ($user->document->files as $file)
                                    <div class="col-md-4 col-3 mb-3">
                                        <img src="{{ asset($file->path) }}" class="img-fluid file-preview" alt="مدرک">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="alert alert-warning text-center">
                    شما هنوز اطلاعات هویتی ثبت نکرده است.
                </div>
            @endif
        </div>
    </div>
@endsection
