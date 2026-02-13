@extends('layouts.admin')

@section('page-title', 'Users')
@section('title', 'Users')

@section('content')
    <div class="page-header mb-4">
        <div class="page-header-title">
            <h5 class="m-b-10">
                <i class="feather-users me-2"></i>Users
            </h5>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">Users</li>
            </ul>
        </div>

        <div class="ms-auto">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="feather-user-plus me-1"></i> Add User
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card stretch stretch-full">
        <div class="card-body">
            @if($users->count())
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ optional($user->role)->name ?? '-' }}</td>
                                    <td>
                                        @if($user->status ?? true)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                      <div class="d-flex justify-content-end gap-2">
                                           
                                             
                                            {{-- secondary action: e.g. edit --}}
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-outline-secondary btn-icon rounded-circle">
                                                <i class="feather-edit-2"></i>  
                                            </a>

    
                                                     <li>
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                            onsubmit="return confirm('Delete this user?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-secondary btn-icon rounded-circle">
                                
                                                                <i class="feather-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            @else
                <p class="mb-0">No users found.</p>
            @endif
        </div>
    </div>
@endsection