@extends('layouts.admin')

@section('page-title', 'Roles')
@section('title', 'Roles')

@section('content')
    <div class="page-header mb-4">
        <div class="d-flex align-items-center w-100">
            {{-- LEFT: title + breadcrumb (e.g. Roles Dashboard > Roles) --}}
            <div class="page-header-title">
                <h5 class="m-b-10 mb-1">
                    <i class="feather-shield me-2"></i>Roles
                </h5>
                <ul class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Roles</li>
                </ul>
            </div>

            {{-- RIGHT: Add Role, pushed to right-most --}}
            <div class="ms-auto">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-1"></i> Add Role
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card stretch stretch-full">
        <div class="card-body">
            @if($roles->count())
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description ?? '-' }}</td>
                                    <td>
                                        @if($role->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                class="btn btn-outline-primary btn-icon rounded-circle">
                                                <i class="feather-edit-2"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this role?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-icon rounded-circle">
                                                    <i class="feather-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mb-0">No roles found.</p>
            @endif
        </div>
    </div>
@endsection