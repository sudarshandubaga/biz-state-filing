@extends('web.layouts.app')
@section('title', 'Resources – BizStateFiling')

@section('page_title', 'Business Resources & Guides')

@section('page_subtitle', 'Learn everything about business formation, compliance, and taxes with our expert guides.')

@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm p-4 sticky top-24">
                            <h3 class="font-semibold text-gray-800 mb-3">Filter Resources</h3>
                            <div class="space-y-3">
                                <div><label class="block text-sm text-gray-600 mb-1">Category</label>
                                    <select onchange="window.location=this.value"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                        <option value="{{ route('web.resources') }}">All Categories</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ route('web.resources') }}?category={{ $cat }}"
                                                {{ request('category') == $cat ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $cat)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div><label class="block text-sm text-gray-600 mb-1">State</label>
                                    <select onchange="window.location=this.value"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                        <option value="{{ route('web.resources') }}">All States</option>
                                        @foreach ($states as $s)
                                            <option value="{{ route('web.resources') }}?state_id={{ $s->id }}"
                                                {{ request('state_id') == $s->id ? 'selected' : '' }}>{{ $s->state_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        @if ($resources->count())
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($resources as $resource)
                                    <a href="{{ route('web.resource-detail', $resource->slug) }}"
                                        class="bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition block">
                                        @if ($resource->image)
                                            <img src="{{ $resource->image }}" alt="{{ $resource->title }}"
                                                class="w-full h-40 object-cover rounded mb-4">
                                        @endif
                                        <div class="flex items-center space-x-2 mb-2">
                                            @if ($resource->featured)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                                            @endif
                                            @if ($resource->category)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucwords(str_replace('_', ' ', $resource->category)) }}</span>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $resource->title }}</h3>
                                        @if ($resource->short_description)
                                            <p class="text-sm text-gray-600">{{ $resource->short_description }}</p>
                                        @endif
                                        @if ($resource->state)
                                            <p class="text-xs text-gray-400 mt-2">{{ $resource->state->state_name }}</p>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                                <p class="text-gray-500">No resources found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
