@extends('admin.layouts.app')
@section('page-title', 'Edit Compliance Deadline')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Compliance Deadline</h1>
        <a href="{{ route('admin.compliance-deadlines.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Cancel</a>
    </div>
    <form method="POST" action="{{ route('admin.compliance-deadlines.update', $complianceDeadline) }}"
        class="bg-white rounded-lg shadow-sm p-6 space-y-6">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deadline Name <span
                        class="text-red-500">*</span></label>
                <input type="text" name="deadline_name"
                    value="{{ old('deadline_name', $complianceDeadline->deadline_name) }}" required
                    class="w-full border rounded px-3 py-2 text-sm">
                @error('deadline_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="2" class="w-full border rounded px-3 py-2 text-sm">{{ old('description', $complianceDeadline->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                <select name="state_id" class="w-full border rounded px-3 py-2 text-sm">
                    <option value="">All States</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}"
                            {{ old('state_id', $complianceDeadline->state_id) == $state->id ? 'selected' : '' }}>
                            {{ $state->state_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entity Type</label>
                <input type="text" name="entity_type" value="{{ old('entity_type', $complianceDeadline->entity_type) }}"
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="e.g. LLC, S-Corp">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deadline Type <span
                        class="text-red-500">*</span></label>
                <select name="deadline_type" id="deadline_type" required class="w-full border rounded px-3 py-2 text-sm"
                    onchange="toggleDeadlineType()">
                    <option value="static"
                        {{ old('deadline_type', $complianceDeadline->deadline_type) == 'static' ? 'selected' : '' }}>Static
                        Date</option>
                    <option value="dynamic"
                        {{ old('deadline_type', $complianceDeadline->deadline_type) == 'dynamic' ? 'selected' : '' }}>
                        Dynamic Rule</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category <span
                        class="text-red-500">*</span></label>
                <input type="text" name="category" value="{{ old('category', $complianceDeadline->category) }}" required
                    class="w-full border rounded px-3 py-2 text-sm" placeholder="e.g. annual_report, tax_filing">
            </div>
            <div id="static_fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fixed Month (1-12)</label>
                    <input type="number" name="fixed_month"
                        value="{{ old('fixed_month', $complianceDeadline->fixed_month) }}" min="1" max="12"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fixed Day (1-31)</label>
                    <input type="number" name="fixed_day" value="{{ old('fixed_day', $complianceDeadline->fixed_day) }}"
                        min="1" max="31" class="w-full border rounded px-3 py-2 text-sm">
                </div>
            </div>
            <div id="dynamic_fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6"
                style="{{ old('deadline_type', $complianceDeadline->deadline_type) == 'static' ? 'display:none' : '' }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rule Label</label>
                    <input type="text" name="rule_label"
                        value="{{ old('rule_label', $complianceDeadline->rule_label) }}"
                        class="w-full border rounded px-3 py-2 text-sm"
                        placeholder="e.g. 15th day of 4th month after tax year">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rule Type <span
                            class="text-red-500">*</span></label>
                    <select name="rule_type" required class="w-full border rounded px-3 py-2 text-sm">
                        <option value="fixed"
                            {{ old('rule_type', $complianceDeadline->rule_type) == 'fixed' ? 'selected' : '' }}>Fixed
                        </option>
                        <option value="days_after_formation"
                            {{ old('rule_type', $complianceDeadline->rule_type) == 'days_after_formation' ? 'selected' : '' }}>
                            Days After Formation</option>
                        <option value="days_after_fy_end"
                            {{ old('rule_type', $complianceDeadline->rule_type) == 'days_after_fy_end' ? 'selected' : '' }}>
                            Days After FY End</option>
                        <option value="anniversary"
                            {{ old('rule_type', $complianceDeadline->rule_type) == 'anniversary' ? 'selected' : '' }}>
                            Anniversary</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rule Days</label>
                    <input type="number" name="rule_days" value="{{ old('rule_days', $complianceDeadline->rule_days) }}"
                        min="0" class="w-full border rounded px-3 py-2 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $complianceDeadline->sort_order) }}"
                    min="0" class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="mt-2">
                    <input type="checkbox" name="status" id="status" value="1"
                        {{ old('status', $complianceDeadline->status) ? 'checked' : '' }} class="mr-2">
                    <label for="status" class="text-sm text-gray-600">Active</label>
                </div>
            </div>
        </div>
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.compliance-deadlines.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Update
                Deadline</button>
        </div>
    </form>
    @push('scripts')
        <script>
            function toggleDeadlineType() {
                var type = document.getElementById('deadline_type').value;
                document.getElementById('static_fields').style.display = type === 'static' ? '' : 'none';
                document.getElementById('dynamic_fields').style.display = type === 'dynamic' ? '' : 'none';
            }
            toggleDeadlineType();
        </script>
    @endpush
@endsection
