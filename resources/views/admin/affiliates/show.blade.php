@extends('admin.layouts.app')
@section('title', $affiliate->name)
@section('page-title', 'Affiliate: ' . $affiliate->name)
@section('content')
    <div class="space-y-6">
        <a href="{{ route('admin.affiliates.index') }}" class="text-blue-600 hover:text-blue-900">&larr; Back to
            Affiliates</a>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Info</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Name</dt>
                        <dd class="font-medium">{{ $affiliate->name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Email</dt>
                        <dd class="font-medium">{{ $affiliate->email }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Phone</dt>
                        <dd class="font-medium">{{ $affiliate->phone ?: 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Company</dt>
                        <dd class="font-medium">{{ $affiliate->company ?: 'N/A' }}</dd>
                    </div>
                    @if ($affiliate->website)
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Website</dt>
                            <dd class="font-medium"><a href="{{ $affiliate->website }}" target="_blank"
                                    class="text-blue-600 hover:underline">{{ $affiliate->website }}</a></dd>
                        </div>
                    @endif
                </dl>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status & Load</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Status</dt>
                        <dd><span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $affiliate->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $affiliate->status ? 'Active' : 'Inactive' }}</span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Available</dt>
                        <dd><span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $affiliate->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $affiliate->is_available ? 'Yes' : 'No' }}</span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Priority</dt>
                        <dd class="font-medium">{{ $affiliate->commission_priority }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">Current Load</dt>
                        <dd class="font-medium">{{ $affiliate->current_load }}/{{ $affiliate->max_load }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        @if ($affiliate->supported_states)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Supported States
                    ({{ count($affiliate->supported_states) }})</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($affiliate->supported_states as $sid)
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">State
                            #{{ $sid }}</span>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($affiliate->supported_entity_types)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Supported Entity Types</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($affiliate->supported_entity_types as $et)
                        <span
                            class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">{{ ucwords(str_replace('-', ' ', $et)) }}</span>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($affiliate->services_offered)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Services Offered</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($affiliate->services_offered as $svc)
                        <span
                            class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ ucwords(str_replace('-', ' ', $svc)) }}</span>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($affiliate->leads->count())
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Assigned Leads ({{ $affiliate->leads->count() }})</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500">ID</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500">Business</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500">Status</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($affiliate->leads as $lead)
                                <tr>
                                    <td class="px-4 py-2 text-sm">#{{ $lead->id }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $lead->business_name }}</td>
                                    <td class="px-4 py-2"><span
                                            class="px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ $lead->status }}</span>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $lead->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($affiliate->webhook_url)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Webhook Configuration</h3>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-gray-500">URL</dt>
                        <dd class="text-sm font-mono">{{ $affiliate->webhook_url }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500">API Key</dt>
                        <dd class="text-sm font-mono">
                            {{ $affiliate->api_key ? substr($affiliate->api_key, 0, 8) . '...' : 'N/A' }}</dd>
                    </div>
                </dl>
            </div>
        @endif
    </div>
@endsection
