@extends('admin.layout')
@section('name', 'مدیریت بنرر')
@section('actions')
    <a href="{{ route('banners.create') }}" class="btn btn-success btn-sm btn-icon-split">
        <span class="text-white-50"><i class="fas fa-plus"></i></span>
        <span class="text">افزودن بنر جدید</span>
    </a>
@endsection

@section('content')

    @session('success')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">لیست بنرها</h6>
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
                    @foreach ($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td><img src="{{ asset($banner->image) }}" width="100"></td>
                            <td>{{ $banner->title }}</td>
                            <td>
                                <span class="badge badge-{{ $banner->is_active ? 'success' : 'secondary' }}">
                                    {{ $banner->is_active ? 'فعال' : 'غیرفعال' }}
                                </span>
                            </td>
                            <td>{{ $banner->order }}</td>
                            <td>
                                <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-primary btn-sm">ویرایش</a>
                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
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

    {!! $banners->links('pagination::bootstrap-5') !!}
@endsection
