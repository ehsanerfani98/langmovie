@extends('admin.layout')
@section('name', 'ویرایش بنر')
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

    <form method="POST" action="{{ route('banners.update', $banner->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">جزئیات بنر</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">عنوان</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $banner->title) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">لینک</label>
                    <input type="url" class="form-control" name="link" value="{{ old('link', $banner->link) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">ترتیب</label>
                    <input type="number" class="form-control" name="order" value="{{ old('order', $banner->order) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">تصویر فعلی</label><br>
                    <img src="{{ asset( $banner->image) }}" width="150">
                </div>
                <div class="mb-3">
                    <label class="form-label">تغییر تصویر (در صورت نیاز)</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                        {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label mr-4" for="is_active">فعال باشد</label>
                </div>

                <button type="submit" class="btn btn-success">بروزرسانی بنر</button>
            </div>
        </div>
    </form>
@endsection
