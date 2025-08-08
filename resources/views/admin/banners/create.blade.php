@extends('admin.layout')
@section('name', 'ایجاد بنر جدید')
@section('actions')
    <a href="{{ route('banners.index') }}" class="btn btn-primary btn-sm btn-icon-split">
        <span class="text-white-50">
            <i class="fas fa-arrow-right"></i>
        </span>
        <span class="text">برگشت</span>
    </a>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">جزئیات بنر</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">لینک</label>
                    <input type="url" class="form-control" name="link" value="{{ old('link') }}">
                </div>
                <div class="mb-3">
                    <label for="order" class="form-label">ترتیب</label>
                    <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">تصویر</label>
                    <input type="file" class="form-control" name="image" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" value="1" class="form-check-input" id="is_active" name="is_active"
                        {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label mr-4" for="is_active">فعال باشد</label>
                </div>

                <button type="submit" class="btn btn-success">ایجاد بنر</button>
            </div>
        </div>
    </form>
@endsection
