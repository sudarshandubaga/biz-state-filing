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

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">Display & Hero Section</h4>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="label" class="block text-sm font-medium text-gray-700 mb-1">Label (e.g., "LLC", "C
                Corp")</label>
            <input type="text" name="label" id="label" value="{{ old('label', $entityType?->label) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="Short label for display">
        </div>
        <div>
            <label for="headline" class="block text-sm font-medium text-gray-700 mb-1">Headline</label>
            <input type="text" name="headline" id="headline" value="{{ old('headline', $entityType?->headline) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="Hero headline text">
        </div>
    </div>

    <div>
        <label for="sub_headline" class="block text-sm font-medium text-gray-700 mb-1">Sub Headline</label>
        <textarea name="sub_headline" id="sub_headline" rows="2"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Hero sub-headline description">{{ old('sub_headline', $entityType?->sub_headline) }}</textarea>
    </div>

    <div>
        <label for="intro_content" class="block text-sm font-medium text-gray-700 mb-1">Intro Content</label>
        <textarea name="intro_content" id="intro_content" rows="4"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="What is this entity type? Detailed intro">{{ old('intro_content', $entityType?->intro_content) }}</textarea>
    </div>

    <div>
        <label for="not_recommended_for" class="block text-sm font-medium text-gray-700 mb-1">Not Recommended
            For</label>
        <input type="text" name="not_recommended_for" id="not_recommended_for"
            value="{{ old('not_recommended_for', $entityType?->not_recommended_for) }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="e.g., High-risk businesses seeking maximum privacy">
    </div>

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">Quick Facts</h4>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="liability_protection" class="block text-sm font-medium text-gray-700 mb-1">Liability
                Protection</label>
            <input type="text" name="liability_protection" id="liability_protection"
                value="{{ old('liability_protection', $entityType?->liability_protection) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., Limited / Full / None">
        </div>
        <div>
            <label for="taxation_type" class="block text-sm font-medium text-gray-700 mb-1">Taxation Type</label>
            <input type="text" name="taxation_type" id="taxation_type"
                value="{{ old('taxation_type', $entityType?->taxation_type) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., Pass-through / Corporate">
        </div>
        <div>
            <label for="ownership_structure" class="block text-sm font-medium text-gray-700 mb-1">Ownership
                Structure</label>
            <input type="text" name="ownership_structure" id="ownership_structure"
                value="{{ old('ownership_structure', $entityType?->ownership_structure) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., Members / Shareholders">
        </div>
        <div>
            <label for="best_for_tagline" class="block text-sm font-medium text-gray-700 mb-1">Best For Tagline</label>
            <input type="text" name="best_for_tagline" id="best_for_tagline"
                value="{{ old('best_for_tagline', $entityType?->best_for_tagline) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., Small business owners / Startups">
        </div>
        <div>
            <label for="formation_cost_range" class="block text-sm font-medium text-gray-700 mb-1">Formation Cost
                Range</label>
            <input type="text" name="formation_cost_range" id="formation_cost_range"
                value="{{ old('formation_cost_range', $entityType?->formation_cost_range) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., $50 - $500">
        </div>
        <div>
            <label for="compliance_level" class="block text-sm font-medium text-gray-700 mb-1">Compliance
                Level</label>
            <input type="text" name="compliance_level" id="compliance_level"
                value="{{ old('compliance_level', $entityType?->compliance_level) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., Low / Medium / High">
        </div>
        <div>
            <label for="complexity_level" class="block text-sm font-medium text-gray-700 mb-1">Complexity
                Level</label>
            <input type="text" name="complexity_level" id="complexity_level"
                value="{{ old('complexity_level', $entityType?->complexity_level) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                placeholder="e.g., Simple / Moderate / Complex">
        </div>
    </div>

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">Tax Details</h4>
    </div>

    <div>
        <label for="tax_deep_dive" class="block text-sm font-medium text-gray-700 mb-1">Tax Deep Dive</label>
        <textarea name="tax_deep_dive" id="tax_deep_dive" rows="4"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Detailed tax explanation">{{ old('tax_deep_dive', $entityType?->tax_deep_dive) }}</textarea>
    </div>

    <div>
        <label for="tax_treatment_summary" class="block text-sm font-medium text-gray-700 mb-1">Tax Treatment
            Summary</label>
        <textarea name="tax_treatment_summary" id="tax_treatment_summary" rows="3"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Summary of tax treatment">{{ old('tax_treatment_summary', $entityType?->tax_treatment_summary) }}</textarea>
    </div>

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">JSON Data (Features, Steps, FAQs, Comparison)</h4>
    </div>

    <div>
        <p class="text-xs text-gray-500 mb-2">Features (array of objects):
            [{"type":"HOW_IT_WORKS|ADVANTAGE|DISADVANTAGE|COMPLIANCE_RULE", "title":"...", "description":"...",
            "icon_class":"bi-..."}]</p>
        <textarea name="features_data" id="features_data" rows="6"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono text-xs"
            placeholder='[{"type":"ADVANTAGE","title":"Liability Protection","description":"Personal assets protected.","icon_class":"bi-shield-check"}]'>{{ old('features_data', $entityType?->features_data ? json_encode($entityType->features_data, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>

    <div>
        <p class="text-xs text-gray-500 mb-2">Steps (array of objects): [{"title":"...", "description":"..."}]</p>
        <textarea name="steps_data" id="steps_data" rows="6"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono text-xs"
            placeholder='[{"title":"Choose a Name","description":"Select a unique business name."}]'>{{ old('steps_data', $entityType?->steps_data ? json_encode($entityType->steps_data, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>

    <div>
        <p class="text-xs text-gray-500 mb-2">FAQs (array of objects): [{"question":"...", "answer":"..."}]</p>
        <textarea name="faqs_data" id="faqs_data" rows="6"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono text-xs"
            placeholder='[{"question":"How does taxation work?","answer":"LLCs have pass-through taxation."}]'>{{ old('faqs_data', $entityType?->faqs_data ? json_encode($entityType->faqs_data, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>

    <div>
        <p class="text-xs text-gray-500 mb-2">Comparison Data (array of objects): [{"label":"...",
            "liability_protection":"...", "taxation_type":"...", "complexity_level":"...", "ownership_structure":"...",
            "best_for_tagline":"..."}]</p>
        <textarea name="comparison_data" id="comparison_data" rows="8"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono text-xs"
            placeholder='[{"label":"LLC","liability_protection":"Limited","taxation_type":"Pass-through","complexity_level":"Simple","ownership_structure":"Members","best_for_tagline":"Small business owners"}]'>{{ old('comparison_data', $entityType?->comparison_data ? json_encode($entityType->comparison_data, JSON_PRETTY_PRINT) : '') }}</textarea>
    </div>

    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-md font-semibold text-gray-800 mb-3">Icon & Description</h4>
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
                    <span
                        class="text-[10px] text-gray-500 mt-1 truncate w-full text-center">{{ $label }}</span>
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
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Brief description (max 255 characters)">
        @error('short_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="12"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
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
        <input type="text" name="seo_title" id="seo_title"
            value="{{ old('seo_title', $entityType?->seo_title) }}" maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Meta title for search engines">
        @error('seo_title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_keywords" class="block text-sm font-medium text-gray-700 mb-1">SEO Keywords</label>
        <textarea name="seo_keywords" id="seo_keywords" rows="2"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Comma-separated keywords">{{ old('seo_keywords', $entityType?->seo_keywords) }}</textarea>
        @error('seo_keywords')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-1">SEO Description</label>
        <textarea name="seo_description" id="seo_description" rows="3"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="Meta description for search engines">{{ old('seo_description', $entityType?->seo_description) }}</textarea>
        @error('seo_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="canonical_url" class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
        <input type="url" name="canonical_url" id="canonical_url"
            value="{{ old('canonical_url', $entityType?->canonical_url) }}" maxlength="255"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iconInput = document.getElementById('icon');
            const iconOptions = document.querySelectorAll('.icon-option');
            iconOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.dataset.value;
                    iconInput.value = value;
                    iconOptions.forEach(opt => {
                        opt.classList.remove('border-blue-500', 'bg-blue-50');
                        opt.classList.add('border-gray-200');
                    });
                    this.classList.add('border-blue-500', 'bg-blue-50');
                    this.classList.remove('border-gray-200');
                    if (!value) {
                        this.classList.remove('border-blue-500', 'bg-blue-50');
                        this.classList.add('border-dashed', 'border-gray-300');
                    }
                });
            });
        });
    </script>
@endpush
