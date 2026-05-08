@extends('admin.layouts.app')
@section('title', 'Blog Posts')
@section('page-title', 'Blog Management')
@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.blogs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title, slug..."
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">All Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <a href="{{ route('admin.blogs.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Clear</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Filter</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Blog Posts</h3>
                <a href="{{ route('admin.blogs.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">+ New Blog
                    Post</a>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categories</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($blogs as $blog)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $blog->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($blog->slug, 40) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($blog->categories as $cat)
                                    <span
                                        class="inline-block px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mr-1">{{ $cat->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full @if ($blog->status == 'published') bg-green-100 text-green-800 @elseif($blog->status == 'draft') bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">{{ ucfirst($blog->status) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $blog->author?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $blog->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('admin.blogs.edit', $blog) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3 inline-flex items-center"
                                    title="Edit"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg></a>
                                <button type="button"
                                    onclick="deleteItem({{ $blog->id }}, '{{ route('admin.blogs.destroy', $blog) }}')"
                                    class="text-red-600 hover:text-red-900 inline-flex items-center" title="Delete"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No blog posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-200">{{ $blogs->links() }}</div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function deleteItem(id, url) {
            if (confirm('Delete this blog post?')) {
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
