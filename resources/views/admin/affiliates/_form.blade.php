@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
        <input type="text" name="name" value="{{ old('name', $affiliate->name ?? '') }}" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
        <input type="email" name="email" value="{{ old('email', $affiliate->email ?? '') }}" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $affiliate->phone ?? '') }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Company</label>
        <input type="text" name="company" value="{{ old('company', $affiliate->company ?? '') }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
        <input type="url" name="website" value="{{ old('website', $affiliate->website ?? '') }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Commission Priority</label>
        <input type="number" name="commission_priority"
            value="{{ old('commission_priority', $affiliate->commission_priority ?? 0) }}" min="0"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Max Load (leads)</label>
        <input type="number" name="max_load" value="{{ old('max_load', $affiliate->max_load ?? 100) }}" min="1"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Webhook URL</label>
        <input type="url" name="webhook_url" value="{{ old('webhook_url', $affiliate->webhook_url ?? '') }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
        <input type="text" name="api_key" value="{{ old('api_key', $affiliate->api_key ?? '') }}"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>
    <div class="flex items-center space-x-6">
        <label class="flex items-center"><input type="checkbox" name="status" value="1"
                {{ old('status', $affiliate->status ?? true) ? 'checked' : '' }}
                class="h-4 w-4 text-blue-600 rounded mr-2"> Active</label>
        <label class="flex items-center"><input type="checkbox" name="is_available" value="1"
                {{ old('is_available', $affiliate->is_available ?? true) ? 'checked' : '' }}
                class="h-4 w-4 text-blue-600 rounded mr-2"> Available for Routing</label>
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Supported States</label>
    <div class="grid grid-cols-4 md:grid-cols-6 gap-2 max-h-48 overflow-y-auto border rounded p-3">
        @foreach ($states as $state)
            <label class="flex items-center text-sm"><input type="checkbox" name="supported_states[]"
                    value="{{ $state->id }}"
                    {{ in_array($state->id, old('supported_states', $affiliate->supported_states ?? [])) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 rounded mr-1"> {{ $state->state_code ?? $state->state_name }}</label>
        @endforeach
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Supported Entity Types</label>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
        @foreach ($entityTypes as $type)
            <label class="flex items-center text-sm"><input type="checkbox" name="supported_entity_types[]"
                    value="{{ $type }}"
                    {{ in_array($type, old('supported_entity_types', $affiliate->supported_entity_types ?? [])) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 rounded mr-1"> {{ ucwords(str_replace('-', ' ', $type)) }}</label>
        @endforeach
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Services Offered</label>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
        @foreach ($services as $service)
            <label class="flex items-center text-sm"><input type="checkbox" name="services_offered[]"
                    value="{{ $service }}"
                    {{ in_array($service, old('services_offered', $affiliate->services_offered ?? [])) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 rounded mr-1"> {{ ucwords(str_replace('-', ' ', $service)) }}</label>
        @endforeach
    </div>
</div>

<div class="mt-8 flex justify-end space-x-3">
    <a href="{{ route('admin.affiliates.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
    <button type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">{{ isset($affiliate) ? 'Update' : 'Create' }}
        Affiliate</button>
</div>
