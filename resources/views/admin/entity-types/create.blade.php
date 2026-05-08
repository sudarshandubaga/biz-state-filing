@extends('admin.layouts.app')

@section('title', 'Create Entity Type')
@section('page-title', 'Create Entity Type')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.entity-types.store') }}" method="POST">
            @csrf
            @include('admin.entity-types._form')
            <div class="mt-6 flex items-center space-x-3">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Create Entity Type
                </button>
                <a href="{{ route('admin.entity-types.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
