@extends('admin.layouts.app')

@section('title', 'Create Admin User')
@section('page-title', 'Create Admin User')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.admin-users.store') }}" method="POST">
            @csrf
            @include('admin.admin-users._form')
            <div class="mt-6 flex items-center space-x-3">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create User
                </button>
                <a href="{{ route('admin.admin-users.index') }}"
                    class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
