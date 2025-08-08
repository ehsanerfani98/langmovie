@extends('admin.layout')
@section('name', 'مدیریت اسلایدر')
@section('actions')
    <a href="{{ route('sliders.create') }}" class="btn btn-success btn-sm btn-icon-split">
        <span class="text-white-50"><i class="fas fa-plus"></i></span>
        <span class="text">افزودن اسلاید جدید</span>
    </a>
@endsection

@section('content')

    @session('success')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">لیست اسلایدها</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>ترتیب</th>
                        <th width="200px">اقدامات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $slider->id }}</td>
                            <td><img src="{{ asset($slider->image) }}" width="100"></td>
                            <td>{{ $slider->title }}</td>
                            <td>
                                <span class="badge badge-{{ $slider->is_active ? 'success' : 'secondary' }}">
                                    {{ $slider->is_active ? 'فعال' : 'غیرفعال' }}
                                </span>
                            </td>
                            <td>{{ $slider->order }}</td>
                            <td>
                                <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $sliders->links('pagination::bootstrap-5') !!}
@endsection
