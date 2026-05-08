@extends('admin.layouts.app')

@section('title', 'Create Industry')
@section('page-title', 'Create Industry')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.industries.store') }}" method="POST">
            @csrf
            @include('admin.industries._form')
            <div class="mt-6 flex items-center space-x-3">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Create Industry
                </button>
                <a href="{{ route('admin.industries.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
