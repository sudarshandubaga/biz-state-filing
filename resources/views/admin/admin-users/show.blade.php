@extends('admin.layouts.app')

@section('title', 'Admin User Details')
@section('page-title', 'Admin User Details')

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">User Information</h3>
            <div class="flex space-x-2">
                <a href="{{ route('admin.admin-users.edit', $admin_user) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Edit User
                </a>
                <a href="{{ route('admin.admin-users.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Back to List
                </a>
            </div>
        </div>
        <div class="px-6 py-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $admin_user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $admin_user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Login Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $admin_user->login_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                    <dd class="mt-1">
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $admin_user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($admin_user->role) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $admin_user->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $admin_user->status ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $admin_user->created_at->format('M d, Y h:i A') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $admin_user->updated_at->format('M d, Y h:i A') }}</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
