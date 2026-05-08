@extends('admin.layouts.app')

@section('title', 'Edit State')
@section('page-title', 'Edit State: ' . $state->state_name)

@section('content')
    <div class="w-full">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Edit State</h3>

            <form action="{{ route('admin.states.update', $state) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.states._form')
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.states.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Update
                        State</button>
                </div>
            </form>
        </div>
    </div>
@endsection
