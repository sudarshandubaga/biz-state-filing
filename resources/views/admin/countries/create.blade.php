@extends('admin.layouts.app')

@section('title', 'Create Country')
@section('page-title', 'Create Country')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">New Country</h3>

            <form action="{{ route('admin.countries.store') }}" method="POST">
                @csrf
                @include('admin.countries._form')
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.countries.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Create
                        Country</button>
                </div>
            </form>
        </div>
    </div>
@endsection
