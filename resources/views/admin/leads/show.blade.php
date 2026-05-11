@extends('admin.layouts.app')
@section('title', 'Lead #' . $lead->id)
@section('page-title', 'Lead #' . $lead->id)
@section('content')
    <div class="space-y-6">
        <a href="{{ route('admin.leads.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to Leads</a>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Business Information</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Business Name</dt>
                        <dd class="font-medium">{{ $lead->business_name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Entity Type</dt>
                        <dd class="font-medium">{{ ucwords(str_replace('-', ' ', $lead->entity_type)) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">State</dt>
                        <dd class="font-medium">{{ $lead->state->state_name ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Address</dt>
                        <dd class="font-medium">{{ $lead->business_address ?: 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Name Available</dt>
                        <dd class="font-medium">{{ $lead->name_available ? 'Yes' : 'No' }}</dd>
                    </div>
                </dl>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Services Needed</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Registered Agent</dt>
                        <dd class="font-medium">{{ $lead->needs_registered_agent ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">EIN Needed</dt>
                        <dd class="font-medium">{{ $lead->needs_ein ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Annual Report</dt>
                        <dd class="font-medium">{{ $lead->needs_annual_report_assistance ? 'Yes' : 'No' }}</dd>
                    </div>
                </dl>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Entity-Specific Data</h3>
                @if ($lead->entity_specific_data)
                    <dl class="space-y-2">
                        @foreach ($lead->entity_specific_data as $key => $value)
                            <div class="flex justify-between">
                                <dt class="text-gray-500 text-sm">{{ ucwords(str_replace('_', ' ', $key)) }}</dt>
                                <dd class="text-sm font-medium">
                                    {{ is_bool($value) ? ($value ? 'Yes' : 'No') : ($value ?: 'N/A') }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @else
                    <p class="text-gray-400">No entity-specific data</p>
                @endif
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Routing & Status</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Status</dt>
                        <dd><span
                                class="px-2 py-1 text-xs font-semibold rounded-full @switch($lead->status) @case('sent') bg-green-100 text-green-800 @break @case('routed') bg-blue-100 text-blue-800 @break @case('matched') bg-purple-100 text-purple-800 @break @default bg-yellow-100 text-yellow-800 @endswitch">{{ ucwords(str_replace('_', ' ', $lead->status)) }}</span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Routing Method</dt>
                        <dd class="font-medium">{{ $lead->routing_method ?: 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Routed To</dt>
                        <dd class="font-medium">{{ $lead->routedAffiliate->name ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Sent to Partner</dt>
                        <dd class="font-medium">{{ $lead->sent_to_partner ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Sent At</dt>
                        <dd class="font-medium">{{ $lead->sent_at ? $lead->sent_at->format('M d, Y g:i A') : 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Created</dt>
                        <dd class="font-medium">{{ $lead->created_at->format('M d, Y g:i A') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        @if ($lead->matched_affiliates)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Matched Affiliates</h3>
                <div class="space-y-3">
                    @foreach ($lead->matched_affiliates as $match)
                        <div class="border rounded p-3 flex justify-between items-center">
                            <div><span class="font-medium">{{ $match['name'] ?? 'N/A' }}</span>
                                @if (!empty($match['company']))
                                    <span class="text-gray-500 text-sm"> - {{ $match['company'] }}</span>
                                @endif
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Score:
                                {{ $match['score'] ?? 0 }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($lead->delivery_log)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Delivery Log</h3>
                <pre class="bg-gray-50 p-4 rounded text-xs overflow-x-auto">{{ json_encode($lead->delivery_log, JSON_PRETTY_PRINT) }}</pre>
            </div>
        @endif
    </div>
@endsection
