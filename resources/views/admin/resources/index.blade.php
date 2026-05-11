@extends('admin.layouts.app')
@section('page-title', 'Resources')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Resources</h1>
        <a href="{{ route('admin.resources.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Add New Resource</a>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex items-center space-x-4">
            <form method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search resources..."
                    class="border rounded px-3 py-2 text-sm w-64">
                <select name="category" class="border rounded px-3 py-2 text-sm">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $cat)) }}</option>
                    @endforeach
                </select>
                <select name="state_id" class="border rounded px-3 py-2 text-sm">
                    <option value="">All States</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                            {{ $state->state_name }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm">Filter</button>
                <a href="{{ route('admin.resources.index') }}" class="text-gray-500 text-sm hover:underline">Clear</a>
            </form>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">State</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Featured</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($resources as $resource)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $resource->title }}</div>
                            @if ($resource->short_description)
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($resource->short_description, 80) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4"><span
                                class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">{{ $resource->category ? ucwords(str_replace('_', ' ', $resource->category)) : 'Uncategorized' }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $resource->state->state_name ?? 'General' }}</td>
                        <td class="px-6 py-4">
                            @if ($resource->featured)
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($resource->status)
                                <span
                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>@else<span
                                    class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.resources.edit', $resource) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($resources->count() === 0)
            <div class="p-8 text-center">
                <p class="text-gray-500">No resources found.</p>
            </div>
        @endif
    </div>
    {{ $resources->appends(request()->query())->links() }}
@endsection
