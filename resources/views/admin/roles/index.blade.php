@extends('admin.layout')
@section('title', 'مدیریت نقش ها')
@section('actions')
    @can('role-create')
        <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm btn-icon-split">
            <span class="text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">ایجاد نقش جدید</span>
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
        <div class="alert alert-danger" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">لیست نقش ها</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="100px">شناسه</th>
                    <th>نقش</th>
                    <th width="300px">اقدامات</th>
                </tr>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->title }}</td>
                        <td>
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm btn-icon-split">
                                <span class="text-white-50">
                                    <i class="fas fa-list"></i>
                                </span>
                                <span class="text">نمایش</span>
                            </a>

                            @can('role-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm btn-icon-split">
                                    <span class="text-white-50">
                                        <i class="fas fa-pen"></i>
                                    </span>
                                    <span class="text">ویرایش</span>
                                </a>
                            @endcan

                            @can('role-delete')
                                @if ($role->name != 'Admin' && $role->name != 'User')
                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')

                                        <button ype="submit" class="btn btn-danger btn-sm btn-icon-split">
                                            <span class="text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">حذف</span>
                                        </button>
                                    </form>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    {!! $roles->links('pagination::bootstrap-5') !!}


@endsection
