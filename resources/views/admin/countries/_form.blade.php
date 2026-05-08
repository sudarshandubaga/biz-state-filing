@if (!isset($country))
    @php $country = null; @endphp
@endif

<div class="space-y-4">
    <div>
        <label for="country_name" class="block text-sm font-medium text-gray-700 mb-1">Country Name <span
                class="text-red-500">*</span></label>
        <input type="text" name="country_name" id="country_name"
            value="{{ old('country_name', $country?->country_name) }}" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('country_name') border-red-500 @enderror"
            placeholder="Enter country name">
        @error('country_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="country_slug" class="block text-sm font-medium text-gray-700 mb-1">Country Slug</label>
        <input type="text" name="country_slug" id="country_slug"
            value="{{ old('country_slug', $country?->country_slug) }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('country_slug') border-red-500 @enderror"
            placeholder="Auto-generated if empty">
        @error('country_slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="iso_code" class="block text-sm font-medium text-gray-700 mb-1">ISO Code</label>
        <input type="text" name="iso_code" id="iso_code" value="{{ old('iso_code', $country?->iso_code) }}"
            maxlength="5"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('iso_code') border-red-500 @enderror"
            placeholder="e.g., US, IN, GB">
        @error('iso_code')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
        <input type="text" name="currency" id="currency" value="{{ old('currency', $country?->currency) }}"
            maxlength="10"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('currency') border-red-500 @enderror"
            placeholder="e.g., USD, INR, EUR">
        @error('currency')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="world_region" class="block text-sm font-medium text-gray-700 mb-1">World Region</label>
        <select name="world_region" id="world_region"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('world_region') border-red-500 @enderror">
            <option value="">Select Region</option>
            @php $selectedRegion = old('world_region', $country?->world_region); @endphp
            <option value="North America" {{ $selectedRegion == 'North America' ? 'selected' : '' }}>North America
            </option>
            <option value="South America" {{ $selectedRegion == 'South America' ? 'selected' : '' }}>South America
            </option>
            <option value="Europe" {{ $selectedRegion == 'Europe' ? 'selected' : '' }}>Europe</option>
            <option value="Asia" {{ $selectedRegion == 'Asia' ? 'selected' : '' }}>Asia</option>
            <option value="Africa" {{ $selectedRegion == 'Africa' ? 'selected' : '' }}>Africa</option>
            <option value="Oceania" {{ $selectedRegion == 'Oceania' ? 'selected' : '' }}>Oceania</option>
            <option value="Antarctica" {{ $selectedRegion == 'Antarctica' ? 'selected' : '' }}>Antarctica</option>
        </select>
        @error('world_region')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
