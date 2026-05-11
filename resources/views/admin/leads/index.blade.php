@extends('admin.layouts.app')
@section('title', 'Leads')
@section('page-title', 'Leads Management')
@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.leads.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, ID, entity..."
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">All Statuses</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="matched" {{ request('status') == 'matched' ? 'selected' : '' }}>Matched</option>
                        <option value="routed" {{ request('status') == 'routed' ? 'selected' : '' }}>Routed</option>
                        <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Entity Type</label>
                    <select name="entity_type"
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">All Types</option>
                        @foreach (['llc' => 'LLC', 's-corporation' => 'S-Corp', 'c-corporation' => 'C-Corp', 'partnership' => 'Partnership', 'sole-proprietorship' => 'Sole Prop', 'professional-entity' => 'Professional', 'foreign-qualification' => 'Foreign Qual'] as $k => $v)
                            <option value="{{ $k }}" {{ request('entity_type') == $k ? 'selected' : '' }}>
                                {{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <a href="{{ route('admin.leads.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Clear</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Filter</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Leads List</h3>
                <span class="text-sm text-gray-500">{{ $leads->total() }} total</span>
            </div>
            <form action="{{ route('admin.leads.bulk-action') }}" method="POST" id="bulkForm">
                @csrf
                <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex items-center space-x-3">
                    <input type="checkbox" id="selectAll"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <select name="action"
                        class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button type="submit"
                        class="px-4 py-1.5 bg-gray-600 text-white rounded-md text-sm font-medium hover:bg-gray-700">Apply</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">
                                    <input type="checkbox" id="selectAllHeader"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Business Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Entity Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    State</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sent</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($leads as $lead)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" name="ids[]"
                                            value="{{ $lead->id }}"
                                            class="row-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $lead->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $lead->business_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"><span
                                            class="text-sm text-gray-900">{{ ucwords(str_replace('-', ' ', $lead->entity_type)) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $lead->state->state_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full @switch($lead->status) @case('sent') bg-green-100 text-green-800 @break @case('routed') bg-blue-100 text-blue-800 @break @case('matched') bg-purple-100 text-purple-800 @break @default bg-yellow-100 text-yellow-800 @endswitch">
                                            {{ ucwords(str_replace('_', ' ', $lead->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($lead->sent_to_partner)
                                        <span class="text-green-600">Yes</span>@else<span
                                                class="text-gray-400">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $lead->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.leads.show', $lead) }}"
                                            class="text-blue-600 hover:text-blue-900 mr-3 inline-flex items-center"
                                            title="View">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                            onclick="deleteItem({{ $lead->id }}, '{{ route('admin.leads.destroy', $lead) }}')"
                                            class="text-red-600 hover:text-red-900 inline-flex items-center" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">No leads found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">{{ $leads->links() }}</div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ['selectAll', 'selectAllHeader'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('change', function() {
                    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this
                        .checked);
                });
            });
            document.getElementById('bulkForm')?.addEventListener('submit', function(e) {
                const action = this.querySelector('[name="action"]').value;
                if (!action) {
                    e.preventDefault();
                    alert('Please select a bulk action.');
                    return;
                }
                if (document.querySelectorAll('.row-checkbox:checked').length === 0) {
                    e.preventDefault();
                    alert('Please select at least one item.');
                    return;
                }
                if (action === 'delete' && !confirm('Delete selected leads?')) {
                    e.preventDefault();
                }
            });
            window.deleteItem = function(id, url) {
                if (confirm('Delete this lead?')) {
                    var f = document.createElement('form');
                    f.method = 'POST';
                    f.action = url;
                    f.style.display = 'none';
                    f.innerHTML = '@csrf<input type="hidden" name="_method" value="DELETE">';
                    document.body.appendChild(f);
                    f.submit();
                }
            };
        });
    </script>
@endpush
