@extends('admin.layouts.app')

@section('title', 'View Entity Comparison')
@section('page-title', 'Entity Comparison Details')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.entity-comparisons.index') }}"
                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                &larr; Back to Comparisons
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('admin.entity-comparisons.edit', $entityComparison) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    Edit Comparison
                </a>
                <button type="button"
                    onclick="deleteItem({{ $entityComparison->id }}, '{{ route('admin.entity-comparisons.destroy', $entityComparison) }}')"
                    class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>

        <!-- Main Detail Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Comparison Information</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Entity Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span class="font-semibold">{{ $entityComparison->entityType?->name ?? 'N/A' }}</span>
                            @if ($entityComparison->entityType?->icon)
                                <i class="fas {{ $entityComparison->entityType->icon }} text-blue-600 ml-1"></i>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Compared Entity Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span class="font-semibold">{{ $entityComparison->comparedEntityType?->name ?? 'N/A' }}</span>
                            @if ($entityComparison->comparedEntityType?->icon)
                                <i class="fas {{ $entityComparison->comparedEntityType->icon }} text-blue-600 ml-1"></i>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Category</dt>
                        <dd class="mt-1">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($entityComparison->category ?? 'General') }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full
                                @if ($entityComparison->status) bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $entityComparison->status ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">State</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $entityComparison->state?->name ?? 'All States' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Country</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $entityComparison->country?->name ?? 'All Countries' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sort Order</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $entityComparison->sort_order }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Title</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $entityComparison->title ?? 'No title' }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Created</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $entityComparison->created_at->format('F d, Y h:i A') }}
                        </dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $entityComparison->updated_at->format('F d, Y h:i A') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Content Card -->
        @if ($entityComparison->content)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Comparison Content</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="prose max-w-none text-sm text-gray-700">
                        {!! nl2br(e($entityComparison->content)) !!}
                    </div>
                </div>
            </div>
        @endif

        <!-- Notes Card -->
        @if ($entityComparison->notes)
            <div class="bg-yellow-50 rounded-lg shadow overflow-hidden border border-yellow-200">
                <div class="px-6 py-4 border-b border-yellow-200 bg-yellow-100">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        Admin Notes
                    </h3>
                </div>
                <div class="px-6 py-4">
                    <p class="text-sm text-gray-700">{{ $entityComparison->notes }}</p>
                </div>
            </div>
        @endif
    </div>

    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        function deleteItem(id, url) {
            if (confirm('Are you sure you want to delete this comparison?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.style.display = 'none';
                var csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                var method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endpush
