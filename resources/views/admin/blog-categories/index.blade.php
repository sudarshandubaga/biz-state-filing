@extends('admin.layouts.app')
@section('title', 'Blog Categories')
@section('page-title', 'Blog Categories')
@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
        @endif
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Categories List</h3>
                <a href="{{ route('admin.blog-categories.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">+ Add New
                    Category</a>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                            </td>
                            <td class="px-6 py-4"><span class="text-sm text-gray-500">{{ $category->slug }}</span></td>
                            <td class="px-6 py-4"><span
                                    class="px-2 py-1 text-xs font-semibold rounded-full @if ($category->status) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">{{ $category->status ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.blog-categories.edit', $category) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3 inline-flex items-center"
                                    title="Edit"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg></a>
                                <button type="button"
                                    onclick="deleteItem({{ $category->id }}, '{{ route('admin.blog-categories.destroy', $category) }}')"
                                    class="text-red-600 hover:text-red-900 inline-flex items-center" title="Delete"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-200">{{ $categories->links() }}</div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function deleteItem(id, url) {
            if (confirm('Delete this category?')) {
                var f = document.createElement('form');
                f.method = 'POST';
                f.action = url;
                f.style.display = 'none';
                var c = document.createElement('input');
                c.type = 'hidden';
                c.name = '_token';
                c.value = '{{ csrf_token() }}';
                f.appendChild(c);
                var m = document.createElement('input');
                m.type = 'hidden';
                m.name = '_method';
                m.value = 'DELETE';
                f.appendChild(m);
                document.body.appendChild(f);
                f.submit();
            }
        }
    </script>
@endpush
