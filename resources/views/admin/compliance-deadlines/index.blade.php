@extends('admin.layouts.app')
@section('page-title', 'Compliance Calendar')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Compliance Calendar</h1>
        <a href="{{ route('admin.compliance-deadlines.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">+ Add New Deadline</a>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search deadlines..."
                    class="border rounded px-3 py-2 text-sm w-64">
                <select name="state_id" class="border rounded px-3 py-2 text-sm">
                    <option value="">All States</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                            {{ $state->state_name }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm">Filter</button>
                <a href="{{ route('admin.compliance-deadlines.index') }}"
                    class="text-gray-500 text-sm hover:underline">Clear</a>
            </form>
        </div>
        @if ($deadlines->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deadline Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">State</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entity Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($deadlines as $deadline)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $deadline->deadline_name }}</div>
                                @if ($deadline->description)
                                    <div class="text-xs text-gray-500 mt-1">{{ $deadline->description }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $deadline->state->state_name ?? 'Federal' }}</td>
                            <td class="px-6 py-4"><span
                                    class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucwords(str_replace('_', ' ', $deadline->category)) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($deadline->deadline_type === 'static' && $deadline->fixed_month && $deadline->fixed_day)
                                    {{ date('F j', mktime(0, 0, 0, $deadline->fixed_month, $deadline->fixed_day)) }}
                                @elseif ($deadline->deadline_type === 'dynamic' && $deadline->rule_label)
                                    <span class="text-xs text-gray-500"
                                        title="{{ $deadline->rule_type }}">{{ $deadline->rule_label }}</span>
                                @else
                                    <span class="text-gray-400">Varies</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $deadline->entity_type ? ucwords(str_replace('-', ' ', $deadline->entity_type)) : 'All' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($deadline->status)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.compliance-deadlines.edit', $deadline) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.compliance-deadlines.destroy', $deadline) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Are you sure?')">
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
                <p class="text-gray-500 mb-4">No compliance deadlines found.</p>
                <a href="{{ route('admin.compliance-deadlines.create') }}"
                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">+ Create the first deadline</a>
            </div>
        @endif
    </div>
    <div class="mt-4">{{ $deadlines->appends(request()->query())->links() }}</div>
@endsection
