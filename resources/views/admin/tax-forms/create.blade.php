@extends('admin.layouts.app')
@section('page-title', 'Create Tax Form')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create Tax Form</h1>
        <a href="{{ route('admin.tax-forms.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancel</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <form method="POST" action="{{ route('admin.tax-forms.store') }}" class="space-y-6">
                @csrf
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Form Name <span
                            class="text-sm text-gray-500">*</span></label>
                    <input type="text" name="form_name" value="{{ old('form_name') }}" required
                        class="w-full border rounded px-3 py-2 text-sm">
                    @error('form_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Form Number (optional)</label>
                    <input type="text" name="form_number" value="{{ old('form_number') }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Description (optional)</label>
                    <textarea name="description" rows="3" class="w-full border rounded px-3 py-2 text-sm">{{ old('description') }}</textarea>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Category <span
                            class="text-sm text-gray-500">*</span></label>
                    <select name="category" required class="w-full border rounded px-3 py-2 text-sm">
                        <option value="">Select Category</option>
                        <option value="formation">Formation</option>
                        <option value="compliance">Compliance</option>
                        <option value="tax">Tax</option>
                    </select>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">State <span
                            class="text-sm text-gray-500">*</span></label>
                    <select name="state_id" required class="w-full border rounded px-3 py-2 text-sm">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Entity Type (optional)</label>
                    <input type="text" name="entity_type" value="{{ old('entity_type') }}"
                        class="w-full border rounded px-3 py-2 text-sm" placeholder="e.g., LLC, S-Corp">
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Download URL (optional)</label>
                    <input type="url" name="download_url" value="{{ old('download_url') }}"
                        class="w-full border rounded px-3 py-2 text-sm" placeholder="https://example.com/file.pdf">
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Official URL (optional)</label>
                    <input type="url" name="official_url" value="{{ old('official_url') }}"
                        class="w-full border rounded px-3 py-2 text-sm" placeholder="https://example.com/official">
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Is Official</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_official" id="is_official"
                            {{ old('is_official') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_official">Make this an official form</label>
                    </div>
                </div>
                <div class="space-y-4">
                    <label class="block text-sm text-gray-600 mb-1">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status"
                            {{ old('status') ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.tax-forms.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-white px-4 py-2 rounded">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Create Tax
                        Form</button>
                </div>
            </form>
        </div>
    </div>
@endsection
