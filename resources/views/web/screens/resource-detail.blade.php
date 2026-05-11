@extends('web.layouts.app')
@section('title', $resource->seo_title ?? $resource->title . ' – BizStateFiling')
@section('meta_description', $resource->seo_description ?? '')
@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('web.resources') }}"
                    class="text-blue-600 hover:text-blue-800 text-sm mb-4 inline-block">&larr; Back to Resources</a>
                <div class="bg-white rounded-lg shadow-sm p-8">
                    @if ($resource->image)
                        <img src="{{ $resource->image }}" alt="{{ $resource->title }}"
                            class="w-full h-64 object-cover rounded mb-6">
                    @endif
                    <div class="flex items-center space-x-2 mb-4">
                        @if ($resource->featured)
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                        @endif
                        @if ($resource->category)
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ ucwords(str_replace('_', ' ', $resource->category)) }}</span>
                        @endif
                        @if ($resource->state)
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $resource->state->state_name }}</span>
                        @endif
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $resource->title }}</h1>
                    @if ($resource->short_description)
                        <p class="text-lg text-gray-600 mb-6">{{ $resource->short_description }}</p>
                    @endif
                    <div class="prose max-w-none">{!! $resource->content !!}</div>
                </div>
                @if ($related->count())
                    <div class="mt-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Related Resources</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach ($related as $rel)
                                <a href="{{ route('web.resource-detail', $rel->slug) }}"
                                    class="bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition">
                                    <h3 class="font-semibold text-gray-900">{{ $rel->title }}</h3>
                                    @if ($rel->short_description)
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($rel->short_description, 80) }}
                                        </p>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
