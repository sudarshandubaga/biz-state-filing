@extends('admin.layouts.app')

@section('title', 'Create Entity Comparison')
@section('page-title', 'Create Entity Comparison')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.entity-comparisons.store') }}" method="POST">
            @csrf
            @include('admin.entity-comparisons._form')
            <div class="mt-6 flex items-center space-x-3">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Create Comparison
                </button>
                <a href="{{ route('admin.entity-comparisons.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
