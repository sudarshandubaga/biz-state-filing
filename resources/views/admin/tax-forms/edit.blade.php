@extends('admin.layouts.app')
@section('page-title', 'Edit Tax Form')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Tax Form</h1>
        <a href="{{ route('admin.tax-forms.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancel</a>
    </div>
    <form method="POST" action="{{ route('admin.tax-forms.update', $taxForm) }}"
        class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Form Name <span
                        class="text-red-500">*</span></label>
                <input type="text" name="form_name" value="{{ old('form_name', $taxForm->form_name) }}" required
                    class="w-full border rounded px-3 py-2 text-sm">
                @error('form_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Form Number</label>
                <input type="text" name="form_number" value="{{ old('form_number', $taxForm->form_number) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2 text-sm">{{ old('description', $taxForm->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category <span
                        class="text-red-500">*</span></label>
                <select name="category" required class="w-full border rounded px-3 py-2 text-sm">
                    <option value="formation" {{ old('category', $taxForm->category) == 'formation' ? 'selected' : '' }}>
                        Formation</option>
                    <option value="compliance" {{ old('category', $taxForm->category) == 'compliance' ? 'selected' : '' }}>
                        Compliance</option>
                    <option value="tax" {{ old('category', $taxForm->category) == 'tax' ? 'selected' : '' }}>Tax</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                <select name="state_id" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">All States</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}"
                            {{ old('state_id', $taxForm->state_id) == $state->id ? 'selected' : '' }}>
                            {{ $state->state_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entity Type</label>
                <input type="text" name="entity_type" value="{{ old('entity_type', $taxForm->entity_type) }}"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="e.g. LLC, S-Corp">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Download URL</label>
                <input type="url" name="download_url" value="{{ old('download_url', $taxForm->download_url) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Official URL</label>
                <input type="url" name="official_url" value="{{ old('official_url', $taxForm->official_url) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Is Official</label>
                <div class="mt-2">
                    <input type="checkbox" name="is_official" id="is_official" value="1"
                        {{ old('is_official', $taxForm->is_official) ? 'checked' : '' }} class="mr-2">
                    <label for="is_official" class="text-sm text-gray-600">Official form</label>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="mt-2">
                    <input type="checkbox" name="status" id="status" value="1"
                        {{ old('status', $taxForm->status) ? 'checked' : '' }} class="mr-2">
                    <label for="status" class="text-sm text-gray-600">Active</label>
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.tax-forms.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Update Tax
                Form</button>
        </div>
    </form>
@endsection
