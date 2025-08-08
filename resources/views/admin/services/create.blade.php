@extends('admin.layout')
@section('name', 'ایجاد خدمت جدید')
@section('actions')
    <a href="{{ route('services.index') }}" class="btn btn-primary btn-sm">برگشت</a>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('services.store') }}">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">جزئیات خدمات</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="icon" class="form-label">آیکن (svg)</label>
                    <textarea class="form-control" id="icon" name="icon"
                        rows="3">{{ old('icon') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">نام خدمت</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">توضیحات</label>
                    <textarea class="form-control" id="description" name="description"
                        rows="16">{{ old('description') }}</textarea>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" value="1" class="form-check-input" id="is_active" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label mr-4" for="is_active">فعال باشد</label>
                </div>

                <button type="submit" class="btn btn-success">ایجاد خدمت</button>
            </div>
        </div>
    </form>
@endsection