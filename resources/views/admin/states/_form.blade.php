@if (!isset($state))
    @php $state = null; @endphp
@endif

<!-- Basic Info -->
<div class="border-b pb-4 mb-4">
    <h4 class="text-md font-semibold text-gray-800 mb-4">Basic Information</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Country <span
                    class="text-red-500">*</span></label>
            <select name="country_id" id="country_id" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('country_id') border-red-500 @enderror">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ old('country_id', $state?->country_id) == $country->id ? 'selected' : '' }}>
                        {{ $country->country_name }}
                    </option>
                @endforeach
            </select>
            @error('country_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="state_name" class="block text-sm font-medium text-gray-700 mb-1">State Name <span
                    class="text-red-500">*</span></label>
            <input type="text" name="state_name" id="state_name" value="{{ old('state_name', $state?->state_name) }}"
                required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('state_name') border-red-500 @enderror"
                placeholder="Enter state name">
            @error('state_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="state_slug" class="block text-sm font-medium text-gray-700 mb-1">State Slug</label>
            <input type="text" name="state_slug" id="state_slug" value="{{ old('state_slug', $state?->state_slug) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('state_slug') border-red-500 @enderror"
                placeholder="Auto-generated if empty">
            @error('state_slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="filing_name" class="block text-sm font-medium text-gray-700 mb-1">Filing Name</label>
            <input type="text" name="filing_name" id="filing_name"
                value="{{ old('filing_name', $state?->filing_name) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('filing_name') border-red-500 @enderror"
                placeholder="Enter filing name">
            @error('filing_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Fees -->
<div class="border-b pb-4 mb-4">
    <h4 class="text-md font-semibold text-gray-800 mb-4">Fees</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="filing_fee" class="block text-sm font-medium text-gray-700 mb-1">Filing Fee ($)</label>
            <input type="number" name="filing_fee" id="filing_fee"
                value="{{ old('filing_fee', $state?->filing_fee ?? 0) }}" step="0.01" min="0"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('filing_fee') border-red-500 @enderror">
            @error('filing_fee')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="late_fee" class="block text-sm font-medium text-gray-700 mb-1">Late Fee ($)</label>
            <input type="number" name="late_fee" id="late_fee" value="{{ old('late_fee', $state?->late_fee ?? 0) }}"
                step="0.01" min="0"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('late_fee') border-red-500 @enderror">
            @error('late_fee')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Deadlines -->
<div class="border-b pb-4 mb-4">
    <h4 class="text-md font-semibold text-gray-800 mb-4">Deadlines</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="deadline_type" class="block text-sm font-medium text-gray-700 mb-1">Deadline Type <span
                    class="text-red-500">*</span></label>
            <select name="deadline_type" id="deadline_type" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('deadline_type') border-red-500 @enderror">
                <option value="fixed" {{ old('deadline_type', $state?->deadline_type) == 'fixed' ? 'selected' : '' }}>
                    Fixed</option>
                <option value="anniversary"
                    {{ old('deadline_type', $state?->deadline_type) == 'anniversary' ? 'selected' : '' }}>Anniversary
                </option>
                <option value="varies"
                    {{ old('deadline_type', $state?->deadline_type) == 'varies' ? 'selected' : '' }}>Varies</option>
            </select>
            @error('deadline_type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="renewal_cycle" class="block text-sm font-medium text-gray-700 mb-1">Renewal Cycle</label>
            <input type="text" name="renewal_cycle" id="renewal_cycle"
                value="{{ old('renewal_cycle', $state?->renewal_cycle) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('renewal_cycle') border-red-500 @enderror"
                placeholder="e.g., Annual, Biennial">
            @error('renewal_cycle')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deadline_month" class="block text-sm font-medium text-gray-700 mb-1">Deadline Month</label>
            <select name="deadline_month" id="deadline_month"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('deadline_month') border-red-500 @enderror">
                <option value="">Select Month</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}"
                        {{ old('deadline_month', $state?->deadline_month) == $i ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
            @error('deadline_month')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deadline_day" class="block text-sm font-medium text-gray-700 mb-1">Deadline Day</label>
            <select name="deadline_day" id="deadline_day"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('deadline_day') border-red-500 @enderror">
                <option value="">Select Day</option>
                @for ($i = 1; $i <= 31; $i++)
                    <option value="{{ $i }}"
                        {{ old('deadline_day', $state?->deadline_day) == $i ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
            @error('deadline_day')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Compliance -->
<div class="border-b pb-4 mb-4">
    <h4 class="text-md font-semibold text-gray-800 mb-4">Compliance</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="compliance_agency" class="block text-sm font-medium text-gray-700 mb-1">Compliance
                Agency</label>
            <input type="text" name="compliance_agency" id="compliance_agency"
                value="{{ old('compliance_agency', $state?->compliance_agency) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('compliance_agency') border-red-500 @enderror"
                placeholder="Enter compliance agency">
            @error('compliance_agency')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center pt-6">
            <input type="checkbox" name="report_required" id="report_required" value="1"
                {{ old('report_required', $state?->report_required ?? true) ? 'checked' : '' }}
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="report_required" class="ml-2 block text-sm text-gray-900">Report Required</label>
        </div>
    </div>
</div>

<!-- URLs -->
<div class="border-b pb-4 mb-4">
    <h4 class="text-md font-semibold text-gray-800 mb-4">URLs</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="portal_url" class="block text-sm font-medium text-gray-700 mb-1">Portal URL</label>
            <input type="url" name="portal_url" id="portal_url"
                value="{{ old('portal_url', $state?->portal_url) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('portal_url') border-red-500 @enderror"
                placeholder="https://">
            @error('portal_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="affiliate_url" class="block text-sm font-medium text-gray-700 mb-1">Affiliate URL</label>
            <input type="url" name="affiliate_url" id="affiliate_url"
                value="{{ old('affiliate_url', $state?->affiliate_url) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('affiliate_url') border-red-500 @enderror"
                placeholder="https://">
            @error('affiliate_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- SEO -->
<div class="border-b pb-4 mb-4">
    <h4 class="text-md font-semibold text-gray-800 mb-4">SEO</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="seo_title" class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
            <input type="text" name="seo_title" id="seo_title"
                value="{{ old('seo_title', $state?->seo_title) }}"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('seo_title') border-red-500 @enderror"
                placeholder="Enter SEO title">
            @error('seo_title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-1">SEO Description</label>
            <textarea name="seo_description" id="seo_description" rows="3"
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('seo_description') border-red-500 @enderror"
                placeholder="Enter SEO description">{{ old('seo_description', $state?->seo_description) }}</textarea>
            @error('seo_description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Status -->
<div class="flex items-center">
    <input type="checkbox" name="status" id="status" value="1"
        {{ old('status', $state?->status ?? true) ? 'checked' : '' }}
        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
    <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
</div>
