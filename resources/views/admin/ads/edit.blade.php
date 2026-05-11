@extends('admin.layouts.app')
@section('page-title', 'Edit Ad')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Ad: {{ $ad->name }}</h1>
        <a href="{{ route('admin.ads.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancel</a>
    </div>
    <form method="POST" action="{{ route('admin.ads.update', $ad) }}" class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ad Name <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $ad->name) }}" required
                    class="w-full border rounded px-3 py-2 text-sm">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="text" name="image" value="{{ old('image', $ad->image) }}"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="https://example.com/ad-banner.jpg">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ad Type <span
                        class="text-red-500">*</span></label>
                <select name="ad_type" required class="w-full border rounded px-3 py-2 text-sm">
                    @foreach (['banner', 'sidebar', 'inline', 'popup'] as $t)
                        <option value="{{ $t }}" {{ old('ad_type', $ad->ad_type) == $t ? 'selected' : '' }}>
                            {{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Target URL</label>
                <input type="url" name="target_url" value="{{ old('target_url', $ad->target_url) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Placement</label>
                <select name="placement" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">Select Placement</option>
                    @foreach (['top_banner' => 'Top Banner', 'sidebar_top' => 'Sidebar Top', 'sidebar_bottom' => 'Sidebar Bottom', 'inline_content' => 'Inline Content', 'footer' => 'Footer', 'bottom_cta' => 'Bottom CTA'] as $k => $v)
                        <option value="{{ $k }}"
                            {{ old('placement', $ad->placement) == $k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category Targeting</label>
                <select name="category" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">All Categories</option>
                    @foreach (['llc_formation' => 'LLC Formation', 'registered_agent' => 'Registered Agent', 'compliance' => 'Compliance', 'tax_forms' => 'Tax Forms', 'business_insurance' => 'Business Insurance'] as $k => $v)
                        <option value="{{ $k }}" {{ old('category', $ad->category) == $k ? 'selected' : '' }}>
                            {{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State Targeting (JSON)</label>
                <input type="text" name="states_targeting"
                    value="{{ old('states_targeting', $ad->states_targeting ? (is_array($ad->states_targeting) ? json_encode($ad->states_targeting) : $ad->states_targeting) : '') }}"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder='["NY","TX","CA"]'>
                <p class="text-xs text-gray-500 mt-1">Leave empty for all states</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Device Targeting</label>
                <select name="device_targeting" class="w-full border rounded px-3 py-2 text-sm">
                    @foreach (['all' => 'All Devices', 'mobile' => 'Mobile Only', 'desktop' => 'Desktop Only'] as $k => $v)
                        <option value="{{ $k }}"
                            {{ old('device_targeting', $ad->device_targeting) == $k ? 'selected' : '' }}>
                            {{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Weight (1-100)</label>
                <input type="number" name="weight" value="{{ old('weight', $ad->weight) }}" min="1" max="100"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Affiliate Partner</label>
                <select name="affiliate_id" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">No Partner</option>
                    @foreach ($affiliates as $aff)
                        <option value="{{ $aff->id }}"
                            {{ old('affiliate_id', $ad->affiliate_id) == $aff->id ? 'selected' : '' }}>{{ $aff->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-sm font-semibold text-gray-700 mb-2 border-b pb-1">UTM Tracking Parameters</h3>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">UTM Source</label>
                <input type="text" name="utm_source" value="{{ old('utm_source', $ad->utm_source) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">UTM Medium</label>
                <input type="text" name="utm_medium" value="{{ old('utm_medium', $ad->utm_medium) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">UTM Campaign</label>
                <input type="text" name="utm_campaign" value="{{ old('utm_campaign', $ad->utm_campaign) }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div class="md:col-span-2">
                <h3 class="text-sm font-semibold text-gray-700 mb-2 border-b pb-1">Schedule & Limits</h3>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input type="date" name="start_date"
                    value="{{ old('start_date', $ad->start_date ? $ad->start_date->format('Y-m-d') : '') }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" name="end_date"
                    value="{{ old('end_date', $ad->end_date ? $ad->end_date->format('Y-m-d') : '') }}"
                    class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Impressions ({{ $ad->current_impressions }}
                    so far)</label>
                <input type="number" name="max_impressions" value="{{ old('max_impressions', $ad->max_impressions) }}"
                    min="0" class="w-full border rounded px-3 py-2 text-sm" placeholder="Unlimited">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Max Clicks ({{ $ad->current_clicks }} so
                    far)</label>
                <input type="number" name="max_clicks" value="{{ old('max_clicks', $ad->max_clicks) }}" min="0"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="Unlimited">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="mt-2">
                    <input type="checkbox" name="status" id="status" value="1"
                        {{ old('status', $ad->status) ? 'checked' : '' }} class="mr-2">
                    <label for="status" class="text-sm text-gray-600">Active</label>
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.ads.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Update
                Ad</button>
        </div>
    </form>
@endsection
