@extends('admin.layouts.app')

@section('title', $entityType->name)
@section('page-title', $entityType->name)

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Entity Type Details</h3>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.entity-types.edit', $entityType) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Edit
                </a>
                <a href="{{ route('admin.entity-types.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Back to List
                </a>
            </div>
        </div>

        <div class="px-6 py-4">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Icon</dt>
                    <dd class="mt-1">
                        @if ($entityType->icon)
                            <i class="fas {{ $entityType->icon }} text-2xl text-blue-600"></i>
                            <span class="text-sm text-gray-500 ml-2"><code>{{ $entityType->icon }}</code></span>
                        @else
                            <span class="text-sm text-gray-500">N/A</span>
                        @endif
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->name }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->slug ?? 'N/A' }}</dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Short Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->short_description ?? 'N/A' }}</dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if ($entityType->description)
                            {!! $entityType->description !!}
                        @else
                            N/A
                        @endif
                    </dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 border-t border-gray-200 pt-4">SEO Details</dt>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">SEO Title</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->seo_title ?? 'N/A' }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Canonical URL</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->canonical_url ?? 'N/A' }}</dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">SEO Keywords</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->seo_keywords ?? 'N/A' }}</dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">SEO Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->seo_description ?? 'N/A' }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded-full
                            @if ($entityType->status) bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $entityType->status ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->created_at->format('M d, Y g:i A') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $entityType->updated_at->format('M d, Y g:i A') }}</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
