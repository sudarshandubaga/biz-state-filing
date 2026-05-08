@if (!isset($entityType))
    @php $entityType = null; @endphp
@endif

<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span
                    class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $entityType?->name) }}" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                placeholder="e.g., LLC, Corporation, Nonprofit">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $entityType?->slug) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('slug') border-red-500 @enderror"
                placeholder="Auto-generated if empty">
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
        <input type="hidden" name="icon" id="icon" value="{{ old('icon', $entityType?->icon) }}">
        @php $selectedIcon = old('icon', $entityType?->icon); @endphp
        <div class="grid grid-cols-5 sm:grid-cols-6 md:grid-cols-8 gap-2" id="iconPicker">
            @php
                $icons = [
                    'fa-building' => 'Building',
                    'fa-briefcase' => 'Briefcase',
                    'fa-handshake' => 'Handshake',
                    'fa-chart-line' => 'Chart Line',
                    'fa-users' => 'Users',
                    'fa-cogs' => 'Cogs',
                    'fa-globe' => 'Globe',
                    'fa-file-alt' => 'File Alt',
                    'fa-balance-scale' => 'Balance Scale',
                    'fa-gavel' => 'Gavel',
                    'fa-university' => 'University',
                    'fa-calculator' => 'Calculator',
                    'fa-clock' => 'Clock',
                    'fa-check-circle' => 'Check Circle',
                    'fa-exclamation-triangle' => 'Exclamation Triangle',
                    'fa-star' => 'Star',
                    'fa-heart' => 'Heart',
                    'fa-shield-alt' => 'Shield Alt',
                    'fa-truck' => 'Truck',
                    'fa-store' => 'Store',
                ];
            @endphp
            <div class="icon-option border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition {{ empty($selectedIcon) ? 'border-blue-500 bg-blue-50' : '' }}"
                data-value="" title="None">
                <span class="text-gray-400 text-xs font-medium">-</span>
            </div>
            @foreach ($icons as $value => $label)
                <div class="icon-option border-2 rounded-md p-2 flex flex-col items-center justify-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition {{ $selectedIcon == $value ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}"
                    data-value="{{ $value }}" title="{{ $label }}">
                    <i class="fas {{ $value }} text-xl text-gray-700"></i>
                    <span class="text-[10px] text-gray-500 mt-1 truncate w-full text-center">{{ $label }}</span>
                </div>
            @endforeach
        </div>
        @error('icon')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
        <input type="text" name="short_description" id="short_description"
            value="{{ old('short_description', $entityType?->short_description) }}" maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('short_description') border-red-500 @enderror"
            placeholder="Brief description (max 255 characters)">
        @error('short_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="12"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('description') border-red-500 @enderror"
            placeholder="Detailed description with rich text...">{{ old('description', $entityType?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">SEO Details</h4>
    </div>

    <div>
        <label for="seo_title" class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
        <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $entityType?->seo_title) }}"
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
            placeholder="Comma-separated keywords">{{ old('seo_keywords', $entityType?->seo_keywords) }}</textarea>
        @error('seo_keywords')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-1">SEO Description</label>
        <textarea name="seo_description" id="seo_description" rows="3"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('seo_description') border-red-500 @enderror"
            placeholder="Meta description for search engines">{{ old('seo_description', $entityType?->seo_description) }}</textarea>
        @error('seo_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="canonical_url" class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
        <input type="url" name="canonical_url" id="canonical_url"
            value="{{ old('canonical_url', $entityType?->canonical_url) }}" maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('canonical_url') border-red-500 @enderror"
            placeholder="https://example.com/canonical-url">
        @error('canonical_url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    @if ($entityType)
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('status') border-red-500 @enderror">
                <option value="1" {{ old('status', $entityType?->status) == 1 ? 'selected' : '' }}>Active
                </option>
                <option value="0" {{ old('status', $entityType?->status) === 0 ? 'selected' : '' }}>Inactive
                </option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @endif
</div>

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Icon picker
            const iconInput = document.getElementById('icon');
            const iconOptions = document.querySelectorAll('.icon-option');

            iconOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.dataset.value;

                    // Update hidden input
                    iconInput.value = value;

                    // Remove active state from all options
                    iconOptions.forEach(opt => {
                        opt.classList.remove('border-blue-500', 'bg-blue-50');
                        opt.classList.add('border-gray-200');
                    });

                    // Add active state to clicked option
                    this.classList.add('border-blue-500', 'bg-blue-50');
                    this.classList.remove('border-gray-200');

                    // If "none" (dashed box) was clicked, reset to dashed style
                    if (!value) {
                        this.classList.remove('border-blue-500', 'bg-blue-50');
                        this.classList.add('border-dashed', 'border-gray-300');
                    }
                });
            });

            // TinyMCE
            tinymce.init({
                selector: '#description',
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
