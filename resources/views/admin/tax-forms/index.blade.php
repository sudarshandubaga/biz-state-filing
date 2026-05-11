@extends('admin.layouts.app')
@section('page-title', 'Tax Forms')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tax Forms</h1>
        <a href="{{ route('admin.tax-forms.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Add New Form</a>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search forms..."
                    class="border rounded px-3 py-2 text-sm w-64">
                <select name="category" class="border rounded px-3 py-2 text-sm">
                    <option value="">All Categories</option>
                    @foreach (['formation' => 'Formation', 'compliance' => 'Compliance', 'tax' => 'Tax'] as $k => $v)
                        <option value="{{ $k }}" {{ request('category') == $k ? 'selected' : '' }}>
                            {{ $v }}</option>
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
                <a href="{{ route('admin.tax-forms.index') }}" class="text-gray-500 text-sm hover:underline">Clear</a>
            </form>
        </div>
        @if ($forms->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Form Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Form #</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">State</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entity Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($forms as $form)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $form->form_name }}</div>
                                @if ($form->description)
                                    <div class="text-xs text-gray-500 mt-1">{{ Str::limit($form->description, 60) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4"><span
                                    class="text-sm text-gray-500 font-mono">{{ $form->form_number ?? '-' }}</span></td>
                            <td class="px-6 py-4"><span
                                    class="text-sm text-gray-500">{{ $form->state->state_name ?? 'Federal' }}</span></td>
                            <td class="px-6 py-4"><span
                                    class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucwords($form->category) }}</span>
                            </td>
                            <td class="px-6 py-4"><span
                                    class="text-sm text-gray-500">{{ $form->entity_type ? ucwords(str_replace('-', ' ', $form->entity_type)) : 'All' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($form->status)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.tax-forms.edit', $form) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.tax-forms.destroy', $form) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-8 text-center">
                <p class="text-gray-500">No tax forms found.</p>
            </div>
        @endif
    </div>
    <div class="mt-4">{{ $forms->appends(request()->query())->links() }}</div>
@endsection
