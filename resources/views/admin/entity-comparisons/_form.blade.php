<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Entity Type (Primary) -->
    <div>
        <label for="entity_type_id" class="block text-sm font-medium text-gray-700 mb-1">Entity Type *</label>
        <select name="entity_type_id" id="entity_type_id" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="">Select Entity Type</option>
            @foreach ($entityTypes as $type)
                <option value="{{ $type->id }}"
                    {{ old('entity_type_id', $entityComparison->entity_type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }} ({{ $type->label ?? ($type->short_description ?? 'N/A') }})
                </option>
            @endforeach
        </select>
        @error('entity_type_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Compared Entity Type -->
    <div>
        <label for="compared_entity_type_id" class="block text-sm font-medium text-gray-700 mb-1">Compared Entity Type
            *</label>
        <select name="compared_entity_type_id" id="compared_entity_type_id" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="">Select Entity Type to Compare</option>
            @foreach ($entityTypes as $type)
                <option value="{{ $type->id }}"
                    {{ old('compared_entity_type_id', $entityComparison->compared_entity_type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }} ({{ $type->label ?? ($type->short_description ?? 'N/A') }})
                </option>
            @endforeach
        </select>
        @error('compared_entity_type_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Category -->
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <select name="category" id="category"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="">Select Category (Optional)</option>
            @foreach ($categories as $key => $label)
                <option value="{{ $key }}"
                    {{ old('category', $entityComparison->category ?? '') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('category')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $entityComparison->title ?? '') }}"
            placeholder="e.g., Taxation Comparison"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- State -->
    <div>
        <label for="state_id" class="block text-sm font-medium text-gray-700 mb-1">State (Optional)</label>
        <select name="state_id" id="state_id"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="">All States</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}"
                    {{ old('state_id', $entityComparison->state_id ?? '') == $state->id ? 'selected' : '' }}>
                    {{ $state->name }}
                </option>
            @endforeach
        </select>
        @error('state_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Country -->
    <div>
        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Country (Optional)</label>
        <select name="country_id" id="country_id"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="">All Countries</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    {{ old('country_id', $entityComparison->country_id ?? '') == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
        @error('country_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Sort Order -->
    <div>
        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
        <input type="number" name="sort_order" id="sort_order"
            value="{{ old('sort_order', $entityComparison->sort_order ?? 0) }}" min="0"
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        @error('sort_order')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Status -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <div class="flex items-center space-x-4 mt-2">
            <label class="inline-flex items-center">
                <input type="radio" name="status" value="1"
                    {{ old('status', $entityComparison->status ?? true) == '1' || old('status', $entityComparison->status ?? true) === true ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="status" value="0"
                    {{ old('status', $entityComparison->status ?? true) == '0' || old('status', $entityComparison->status ?? true) === false ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Inactive</span>
            </label>
        </div>
        @error('status')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<!-- Content -->
<div class="mt-6">
    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Comparison Content</label>
    <textarea name="content" id="content" rows="8"
        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        placeholder="Enter the comparison content/description...">{{ old('content', $entityComparison->content ?? '') }}</textarea>
    @error('content')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Notes -->
<div class="mt-6">
    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Admin Notes (Internal)</label>
    <textarea name="notes" id="notes" rows="3"
        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        placeholder="Internal notes about this comparison...">{{ old('notes', $entityComparison->notes ?? '') }}</textarea>
    @error('notes')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
