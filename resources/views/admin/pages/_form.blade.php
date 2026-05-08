@if (!isset($page))
    @php $page = null; @endphp
@endif

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span
                    class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $page?->title) }}" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('title') border-red-500 @enderror"
                placeholder="e.g., About Us, Privacy Policy">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $page?->slug) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('slug') border-red-500 @enderror"
                placeholder="Auto-generated if empty">
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="short_summary" class="block text-sm font-medium text-gray-700 mb-1">Short Summary</label>
        <textarea name="short_summary" id="short_summary" rows="3" maxlength="500"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('short_summary') border-red-500 @enderror"
            placeholder="Brief summary (max 500 characters)">{{ old('short_summary', $page?->short_summary) }}</textarea>
        @error('short_summary')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="long_description" class="block text-sm font-medium text-gray-700 mb-1">Long Description</label>
        <textarea name="long_description" id="long_description" rows="12"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('long_description') border-red-500 @enderror"
            placeholder="Detailed page content...">{{ old('long_description', $page?->long_description) }}</textarea>
        @error('long_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
        <input type="text" name="image" id="image" value="{{ old('image', $page?->image) }}" maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('image') border-red-500 @enderror"
            placeholder="https://example.com/image.jpg">
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="template" class="block text-sm font-medium text-gray-700 mb-1">Template</label>
        <select name="template" id="template"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('template') border-red-500 @enderror">
            <option value="default" {{ old('template', $page?->template) == 'default' ? 'selected' : '' }}>Default Page
            </option>
        </select>
        @error('template')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">SEO Details</h4>
    </div>

    <div>
        <label for="seo_title" class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
        <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $page?->seo_title) }}"
            maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('seo_title') border-red-500 @enderror"
            placeholder="Meta title for search engines">
        @error('seo_title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_keywords" class="block text-sm font-medium text-gray-700 mb-1">SEO Keywords</label>
        <textarea name="seo_keywords" id="seo_keywords" rows="2"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('seo_keywords') border-red-500 @enderror"
            placeholder="Comma-separated keywords">{{ old('seo_keywords', $page?->seo_keywords) }}</textarea>
        @error('seo_keywords')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-1">SEO Description</label>
        <textarea name="seo_description" id="seo_description" rows="3"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('seo_description') border-red-500 @enderror"
            placeholder="Meta description for search engines">{{ old('seo_description', $page?->seo_description) }}</textarea>
        @error('seo_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="canonical_url" class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
        <input type="url" name="canonical_url" id="canonical_url"
            value="{{ old('canonical_url', $page?->canonical_url) }}" maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('canonical_url') border-red-500 @enderror"
            placeholder="https://example.com/canonical-url">
        @error('canonical_url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" id="status"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('status') border-red-500 @enderror">
            <option value="1" {{ old('status', $page?->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $page?->status ?? 1) === 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#long_description',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                branding: false,
                toolbar: 'undo redo | blocks fontsize | ' +
                    'bold italic forecolor backcolor  | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help code',
                content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:14px }'
            });
        });
    </script>
@endpush
