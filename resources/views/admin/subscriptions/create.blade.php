@extends('admin.layout')
@section('title', 'ایجاد اشتراک جدید')

@section('content')
    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">جزئیات اشتراک</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="icon" class="form-label">آیکن (svg)</label>
                    <textarea class="form-control" id="icon" name="icon"
                        rows="3">{{ old('icon') }}</textarea>
                </div>
                <div class="mb-3">
                    <label>نام اشتراک</label>
                    <input type="text" name="name" class="form-control" required maxlength="100" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label>قیمت (ریال)</label>
                    <input type="number" name="price" class="form-control" required value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label>مدت زمان (روز)</label>
                    <input type="number" name="duration_days" class="form-control" required
                        value="{{ old('duration_days') }}">
                </div>
                <div class="mb-3">
                    <label>تعداد جستجوی روزانه</label>
                    <input type="number" name="daily_search_limit" class="form-control" required
                        value="{{ old('daily_search_limit') }}">
                </div>

                <div class="mb-3">
                    <label>تعداد نمایش سکانس در هر جستجو</label>
                    <input type="number" name="daily_segment_limit" class="form-control" required
                        value="{{ old('daily_segment_limit') }}">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" value="1" class="form-check-input" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label mr-4" for="is_active">فعال باشد</label>
                </div>

                <button type="submit" class="btn btn-success">ثبت اشتراک</button>
            </div>
        </div>
    </form>
@endsection