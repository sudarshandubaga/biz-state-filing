@extends('admin.layouts.app')

@section('title', 'Countries')
@section('page-title', 'Countries Management')

@section('content')
    <div class="space-y-6">
        <!-- Success/Error Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filters Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.countries.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, slug or ISO code..."
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">World Region</label>
                    <select name="world_region"
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">All Regions</option>
                        <option value="North America" {{ request('world_region') == 'North America' ? 'selected' : '' }}>
                            North America</option>
                        <option value="South America" {{ request('world_region') == 'South America' ? 'selected' : '' }}>
                            South America</option>
                        <option value="Europe" {{ request('world_region') == 'Europe' ? 'selected' : '' }}>Europe</option>
                        <option value="Asia" {{ request('world_region') == 'Asia' ? 'selected' : '' }}>Asia</option>
                        <option value="Africa" {{ request('world_region') == 'Africa' ? 'selected' : '' }}>Africa</option>
                        <option value="Oceania" {{ request('world_region') == 'Oceania' ? 'selected' : '' }}>Oceania
                        </option>
                        <option value="Antarctica" {{ request('world_region') == 'Antarctica' ? 'selected' : '' }}>
                            Antarctica</option>
                    </select>
                </div>

                <div class="flex items-end space-x-2">
                    <a href="{{ route('admin.countries.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Clear</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">Filter</button>
                </div>
            </form>
        </div>

        <!-- Countries Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Countries List</h3>
                <a href="{{ route('admin.countries.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                    + Add New Country
                </a>
            </div>

            <form action="{{ route('admin.countries.bulk-action') }}" method="POST" id="bulkForm">
                @csrf
                <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex items-center space-x-3">
                    <input type="checkbox" id="selectAll"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <select name="action"
                        class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Bulk Actions</option>
                        <option value="activate">Activate</option>
                        <option value="deactivate">Deactivate</option>
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
                                    Country</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ISO Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Currency</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Region</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    States</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($countries as $country)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="ids[]" value="{{ $country->id }}"
                                            class="row-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $country->country_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $country->country_slug }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $country->iso_code ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $country->currency ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $country->world_region ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $country->states_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full
                                            @if ($country->status) bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $country->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $country->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.countries.edit', $country) }}"
                                            class="text-blue-600 hover:text-blue-900 mr-3 inline-flex items-center"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                            onclick="deleteItem({{ $country->id }}, '{{ route('admin.countries.destroy', $country) }}')"
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
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">No countries found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $countries->links() }}
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const selectAllHeader = document.getElementById('selectAllHeader');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkForm = document.getElementById('bulkForm');

            function toggleAll(checkbox) {
                rowCheckboxes.forEach(cb => cb.checked = checkbox.checked);
            }

            selectAll.addEventListener('change', function() {
                toggleAll(this);
                if (selectAllHeader) selectAllHeader.checked = this.checked;
            });

            if (selectAllHeader) {
                selectAllHeader.addEventListener('change', function() {
                    toggleAll(this);
                    if (selectAll) selectAll.checked = this.checked;
                });
            }

            bulkForm.addEventListener('submit', function(e) {
                const action = this.querySelector('[name="action"]').value;
                const checked = this.querySelectorAll('.row-checkbox:checked');
                if (!action) {
                    e.preventDefault();
                    alert('Please select a bulk action.');
                    return;
                }
                if (checked.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one item.');
                    return;
                }
                if (action === 'delete' && !confirm('Are you sure you want to delete selected items?')) {
                    e.preventDefault();
                    return;
                }
            });

            window.deleteItem = function(id, url) {
                if (confirm('Are you sure you want to delete this country?')) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';
                    var csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);
                    var method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);
                    document.body.appendChild(form);
                    form.submit();
                }
            };
        });
    </script>
@endpush
