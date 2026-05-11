@extends('admin.layouts.app')
@section('page-title', 'Create Resource')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create Resource</h1>
        <a href="{{ route('admin.resources.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancel</a>
    </div>
    <form method="POST" action="{{ route('admin.resources.store') }}" class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full border rounded px-3 py-2 text-sm">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug (leave empty to auto-generate)</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category') }}"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="e.g. llc_guide, compliance">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                <textarea name="short_description" rows="2" class="w-full border rounded px-3 py-2 text-sm">{{ old('short_description') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Content (HTML)</label>
                <textarea name="content" rows="12" class="w-full border rounded px-3 py-2 text-sm">{{ old('content') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                <select name="state_id" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">General</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                            {{ $state->state_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entity Type</label>
                <input type="text" name="entity_type" value="{{ old('entity_type') }}"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="e.g. LLC, S-Corp">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="text" name="image" value="{{ old('image') }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title') }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">SEO Description</label>
                <textarea name="seo_description" rows="2" class="w-full border rounded px-3 py-2 text-sm">{{ old('seo_description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Featured</label>
                <div class="mt-2">
                    <input type="checkbox" name="featured" id="featured" value="1"
                        {{ old('featured') ? 'checked' : '' }} class="mr-2">
                    <label for="featured" class="text-sm text-gray-600">Show as featured resource</label>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="mt-2">
                    <input type="checkbox" name="status" id="status" value="1"
                        {{ old('status', true) ? 'checked' : '' }} class="mr-2">
                    <label for="status" class="text-sm text-gray-600">Active</label>
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.resources.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Create
                Resource</button>
        </div>
    </form>
@endsection
