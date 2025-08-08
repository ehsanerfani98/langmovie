@extends('admin.layout')
@section('title', 'مدیریت کاربران')
@section('actions')
    @can('user-create')
        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm btn-icon-split">
            <span class="text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">ایجاد کاربر جدید</span>
        </a>
    @endcan
@endsection
@section('content')
    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession
    @session('error')
        <div class="alert alert-info" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">لیست کاربران</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>شماره موبایل</th>
                    <th>نقش ها</th>
                    <th>وضعیت مسدودیت</th>
                    <th width="300px">اقدامات</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ optional($user->document)->first_name . ' ' . optional($user->document)->last_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->roleObjects as $role)
                                    <label class="badge badge-success">{{ $role->title }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if (Illuminate\Support\Facades\Redis::exists("blocked:{$user->id}"))
                                <span class="badge badge-danger">مسدود شده</span>
                            @else
                                <span class="badge badge-success">فعال</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#actionsModal-{{ $user->id }}">
                                <i class="fas fa-cogs"></i> گزینه ها
                            </button>
                            <div class="modal fade" id="actionsModal-{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="actionsModalLabel-{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="actionsModalLabel-{{ $user->id }}">اقدامات
                                                کاربر
                                            </h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-2">
                                            @can('user-edit')
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm mb-1">
                                                    <i class="fas fa-pen"></i> ویرایش
                                                </a>
                                            @endcan
                                            <a href="{{ route('documents.show', $user->id) }}"
                                                class="btn btn-sm btn-success mb-1">
                                                <i class="fas fa-id-card"></i> مشاهده مدارک
                                            </a>
                                            @if (Illuminate\Support\Facades\Redis::exists("blocked:{$user->id}"))
                                                <form method="POST" action="{{ route('users.unblock', $user->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning w-100 mb-1">
                                                        <i class="fas fa-unlock"></i> رفع مسدودیت
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('transactions.show', $user->id) }}"
                                                class="btn btn-sm btn-info btn-sm mb-1">
                                                <i class="fas fa-receipt"></i> تراکنش‌ها
                                            </a>
                                            <a href="{{ route('wallets.show', $user->id) }}"
                                                class="btn btn-sm btn-warning btn-sm mb-1">
                                                <i class="fas fa-wallet"></i> کیف پول
                                            </a>
                                            <a href="{{ route('subscriptions.show', $user->id) }}"
                                                class="btn btn-sm btn-secondary btn-sm">
                                                <i class="fas fa-star"></i> اشتراک‌ها
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    {!! $data->links('pagination::bootstrap-5') !!}

@endsection
