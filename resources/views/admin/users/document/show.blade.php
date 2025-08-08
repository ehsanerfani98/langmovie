@extends('admin.layout')
@section('name', 'مشاهده مدارک کاربر')
@section('actions')
    <a href="{{ route('documents.edit', $user->id) }}" class="btn btn-success btn-sm btn-icon-split">
        <span class="text-white-50">
            <i class="fas fa-pen"></i>
        </span>
        <span class="text">ویراش مدارک</span>
    </a>
    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm btn-icon-split">
        <span class="text-white-50">
            <i class="fas fa-arrow-right"></i>
        </span>
        <span class="text">برگشت</span>
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">اطلاعات مدارک {{ $user->name }}</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>نوع کاربر</th>
                        <td>{{ $document->type == 'individual' ? 'حقیقی' : 'حقوقی' }}</td>
                    </tr>
                    <tr>
                        <th>نام</th>
                        <td>{{ $document->first_name }}</td>
                    </tr>
                    <tr>
                        <th>نام خانوادگی</th>
                        <td>{{ $document->last_name }}</td>
                    </tr>
                    <tr>
                        <th>شماره موبایل</th>
                        <td>{{ $document->mobile }}</td>
                    </tr>
                    <tr>
                        <th>کد ملی</th>
                        <td>{{ $document->national_id }}</td>
                    </tr>
                    <tr>
                        <th>نام شرکت</th>
                        <td>{{ $document->company_name }}</td>
                    </tr>
                    <tr>
                        <th>آدرس شرکت</th>
                        <td>{{ $document->company_address }}</td>
                    </tr>
                    <tr>
                        <th>وضعیت تایید</th>
                        <td>
                            @if ($document->is_verified)
                                <span class="badge badge-success">تأیید شده</span>
                            @elseif($document->needs_correction)
                                <span class="badge badge-warning">نیاز به اصلاح</span>
                            @else
                                <span class="badge badge-warning">در انتظار بررسی</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>توضیحات اصلاحیه</th>
                        <td>{{ $document->description ?: 'ندارد' }}</td>
                    </tr>
                </tbody>
            </table>

            <hr>
            <h6 class="mb-3">فایل‌های پیوست</h6>
            @if ($document->files->count())
                <div class="row">
                    @foreach ($document->files as $file)
                        <div class="col-md-3 text-center mb-4">
                            <div class="border p-2 rounded">
                                @if (Str::endsWith($file->path, ['.jpg', '.jpeg', '.png', '.webp']))
                                    <img src="{{ asset($file->path) }}" class="img-fluid rounded mb-2"
                                        style="max-height: 100px;">
                                @else
                                    <a download href="{{ asset($file->path) }}" target="_blank" class="d-block mb-2">نمایش
                                        فایل</a>
                                @endif
                                <a download href="{{ asset($file->path) }}" target="_blank"
                                    class="btn btn-sm btn-info">دانلود</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">هیچ فایلی آپلود نشده است.</p>
            @endif

        </div>
    </div>
@endsection
