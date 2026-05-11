@extends('admin.layouts.app')
@section('page-title', 'Ads Management')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ads Management</h1>
        <a href="{{ route('admin.ads.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">+
            Add New Ad</a>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ads..."
                    class="border rounded px-3 py-2 text-sm w-64">
                <select name="placement" class="border rounded px-3 py-2 text-sm">
                    <option value="">All Placements</option>
                    @foreach (['top_banner', 'sidebar_top', 'sidebar_bottom', 'inline_content', 'footer', 'bottom_cta'] as $p)
                        <option value="{{ $p }}" {{ request('placement') == $p ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $p)) }}</option>
                    @endforeach
                </select>
                <select name="category" class="border rounded px-3 py-2 text-sm">
                    <option value="">All Categories</option>
                    @foreach (['llc_formation', 'registered_agent', 'compliance', 'tax_forms', 'business_insurance'] as $c)
                        <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $c)) }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm">Filter</button>
                <a href="{{ route('admin.ads.index') }}" class="text-gray-500 text-sm hover:underline">Clear</a>
            </form>
        </div>
        @if ($ads->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ad Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Placement</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Impressions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clicks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($ads as $ad)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $ad->name }}</div>
                                @if ($ad->affiliate)
                                    <div class="text-xs text-gray-500">Partner: {{ $ad->affiliate->name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4"><span
                                    class="text-sm text-gray-500">{{ ucwords(str_replace('_', ' ', $ad->placement ?? 'none')) }}</span>
                            </td>
                            <td class="px-6 py-4"><span
                                    class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">{{ $ad->category ? ucwords(str_replace('_', ' ', $ad->category)) : 'General' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $ad->current_impressions }}{{ $ad->max_impressions ? '/' . $ad->max_impressions : '' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $ad->current_clicks }}{{ $ad->max_clicks ? '/' . $ad->max_clicks : '' }}</td>
                            <td class="px-6 py-4">
                                @if ($ad->status && $ad->isActive())
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.ads.edit', $ad) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete this ad?')">
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
                <p class="text-gray-500 mb-4">No ads created yet.</p><a href="{{ route('admin.ads.create') }}"
                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">+ Create your first ad</a>
            </div>
        @endif
    </div>
    <div class="mt-4">{{ $ads->appends(request()->query())->links() }}</div>
@endsection
