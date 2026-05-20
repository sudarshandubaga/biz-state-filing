@extends('web.layouts.app')

@section('title', 'State Filing Deadlines 2026 | StateFilingDeadlines')
@section('meta_description',
    'View 2026 business filing deadlines for all US states for LLCs, Corporations, and
    Nonprofits. Avoid late fees with our compliance calendar.')

@section('page_badge')
    <i class="fa-solid fa-calendar-check"></i>
    2026 Compliance Season
@endsection

@section('page_title', 'State Filing Deadlines')

@section('page_subtitle', 'Stay compliant with all 50 states. View annual report dates, tax filing deadlines, and
    business renewal requirements for your entity type.')

@section('content')

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <h2 class="text-2xl font-bold mb-6" id="deadlines-table">2026 Deadline Schedule</h2>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    @php
                        $monthNames = [
                            '',
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December',
                        ];
                    @endphp
                    @foreach (($deadlines ?? [])->take(2) as $deadline)
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all {{ $deadline->fixed_month == now()->month ? 'border-t-4 border-t-red-500' : 'border-t-4 border-t-blue-700' }}">
                            <div class="p-5">
                                <h6 class="text-gray-500 text-xs font-bold uppercase tracking-wider">
                                    {{ $deadline->entity_type ?? 'General' }} {{ $deadline->deadline_name ?? 'Filing' }}
                                </h6>
                                <h4 class="text-xl font-bold mt-1">{{ $monthNames[$deadline->fixed_month] ?? 'TBD' }}
                                    {{ $deadline->fixed_day ? ', ' . $deadline->fixed_day : '' }}</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $deadline->description ?? ($deadline->state ? $deadline->state->state_name . ' filing requirement' : 'State filing requirement') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    @if (($deadlines ?? [])->count() == 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 border-t-4 border-t-blue-700 p-5">
                            <h6 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Annual Report</h6>
                            <h4 class="text-xl font-bold mt-1">Varies by State</h4>
                            <p class="text-sm text-gray-600 mt-1">Most states require an annual report filing to maintain
                                good standing.</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 border-t-4 border-t-red-500 p-5">
                            <h6 class="text-gray-500 text-xs font-bold uppercase tracking-wider">Franchise Tax</h6>
                            <h4 class="text-xl font-bold mt-1">Varies by State</h4>
                            <p class="text-sm text-gray-600 mt-1">Penalty for late filing may include fees plus interest.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Deadline Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th
                                        class="text-left px-4 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        State</th>
                                    <th
                                        class="text-left px-4 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Entity Type</th>
                                    <th
                                        class="text-left px-4 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Requirement</th>
                                    <th
                                        class="text-left px-4 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Due Date</th>
                                    <th
                                        class="text-left px-4 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (($deadlines ?? []) as $deadline)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 font-medium">
                                            {{ $deadline->state ? $deadline->state->state_name : 'Federal' }}</td>
                                        <td class="px-4 py-3">{{ $deadline->entity_type ?? 'All' }}</td>
                                        <td class="px-4 py-3">{{ $deadline->deadline_name }}</td>
                                        <td class="px-4 py-3">
                                            {{ $monthNames[$deadline->fixed_month] ?? 'N/A' }}
                                            @if ($deadline->fixed_day)
                                                ,
                                                {{ $deadline->fixed_day }}{{ in_array($deadline->fixed_day, [1, 21, 31]) ? 'st' : (in_array($deadline->fixed_day, [2, 22]) ? 'nd' : (in_array($deadline->fixed_day, [3, 23]) ? 'rd' : 'th')) }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($deadline->late_fee > 0)
                                                ${{ number_format($deadline->late_fee, 2) }}
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    @foreach ($states ?? [] as $state)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-3 font-medium">{{ $state->state_name }}</td>
                                            <td class="px-4 py-3">LLC</td>
                                            <td class="px-4 py-3">Annual Report</td>
                                            <td class="px-4 py-3">
                                                @if ($state->deadline_month)
                                                    {{ $monthNames[$state->deadline_month] ?? 'N/A' }}
                                                    @if ($state->deadline_day)
                                                        , {{ $state->deadline_day }}th
                                                    @endif
                                                @else
                                                    Anniversary Month
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">${{ number_format($state->filing_fee, 2) }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-3 font-medium">{{ $state->state_name }}</td>
                                            <td class="px-4 py-3">Corporation</td>
                                            <td class="px-4 py-3">Annual Report</td>
                                            <td class="px-4 py-3">
                                                @if ($state->deadline_month)
                                                    {{ $monthNames[$state->deadline_month] ?? 'N/A' }}
                                                    @if ($state->deadline_day)
                                                        , {{ $state->deadline_day }}th
                                                    @endif
                                                @else
                                                    March 1st
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">${{ number_format($state->filing_fee, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Late Filing Info -->
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-3">Late Filing Penalties</h3>
                    <p class="text-gray-700">Missing a filing deadline can lead to administrative dissolution of your
                        business. If your business is dissolved, you lose your liability protection and your business name
                        becomes available for others to claim. Most states also charge late fees and interest on overdue
                        filings.</p>
                    <div class="mt-4 p-4 bg-amber-50 border-l-4 border-amber-400 text-gray-800 rounded-r-lg">
                        <strong>Note:</strong> Most state filings must be completed online through the Secretary of State
                        portal. Deadlines may vary by entity type and business structure.
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-28">
                    <h5 class="text-lg font-bold mb-3">Easy Compliance Guide</h5>
                    <p class="text-sm text-gray-600 mb-4">Use our 9-step automated system to handle your state filings in
                        minutes.</p>

                    <ul class="space-y-2.5 mb-6">
                        <li class="flex items-center gap-2.5 text-sm">
                            <span
                                class="w-6 h-6 bg-blue-700 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                            Check Entity Status
                        </li>
                        <li class="flex items-center gap-2.5 text-sm">
                            <span
                                class="w-6 h-6 bg-blue-700 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                            Verify Registered Agent
                        </li>
                        <li class="flex items-center gap-2.5 text-sm">
                            <span
                                class="w-6 h-6 bg-blue-700 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                            Generate Articles/Reports
                        </li>
                        <li class="text-sm text-gray-400 ml-9">...and 6 more steps</li>
                    </ul>

                    <a href="{{ route('formation.start') }}"
                        class="block w-full bg-blue-700 hover:bg-blue-800 text-white text-center py-3.5 rounded-lg font-bold transition-all shadow-md">
                        Start 9-Step Filing <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>

                    <p class="text-center text-xs text-gray-400 mt-3">
                        <i class="fa-solid fa-shield-halved mr-1"></i> Secure State Submission
                    </p>

                    <!-- Filter by State -->
                    <hr class="my-5">
                    <h6 class="font-bold text-sm mb-2">Filter by State</h6>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach (($states ?? [])->take(8) as $state)
                            <a href="{{ route('web.state-detail', $state->state_slug) }}"
                                class="text-xs bg-gray-100 hover:bg-blue-100 hover:text-blue-700 px-2.5 py-1 rounded-full transition-colors">{{ $state->state_name }}</a>
                        @endforeach
                        @if (($states ?? [])->count() > 8)
                            <a href="{{ route('web.states') }}" class="text-xs text-blue-700 font-medium px-2.5 py-1">View
                                All</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- State List Footer Section -->
    <section class="bg-gray-50 border-t border-gray-200 py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-xl font-bold mb-6 text-center">All States Filing Deadlines</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                @foreach ($states ?? [] as $state)
                    <a href="{{ route('web.state-detail', $state->state_slug) }}"
                        class="bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-sm font-medium hover:border-blue-300 hover:text-blue-700 hover:shadow-sm transition-all">
                        {{ $state->state_name }}
                    </a>
                @endforeach
                @if (($states ?? [])->count() == 0)
                    @php
                        $sampleStates = [
                            'Alabama',
                            'Alaska',
                            'Arizona',
                            'Arkansas',
                            'California',
                            'Colorado',
                            'Connecticut',
                            'Delaware',
                            'Florida',
                            'Georgia',
                            'Hawaii',
                            'Idaho',
                            'Illinois',
                            'Indiana',
                            'Iowa',
                            'Kansas',
                            'Kentucky',
                            'Louisiana',
                            'Maine',
                            'Maryland',
                            'Massachusetts',
                            'Michigan',
                            'Minnesota',
                            'Mississippi',
                            'Missouri',
                            'Montana',
                            'Nebraska',
                            'Nevada',
                            'New Hampshire',
                            'New Jersey',
                            'New Mexico',
                            'New York',
                            'North Carolina',
                            'North Dakota',
                            'Ohio',
                            'Oklahoma',
                            'Oregon',
                            'Pennsylvania',
                            'Rhode Island',
                            'South Carolina',
                            'South Dakota',
                            'Tennessee',
                            'Texas',
                            'Utah',
                            'Vermont',
                            'Virginia',
                            'Washington',
                            'West Virginia',
                            'Wisconsin',
                            'Wyoming',
                        ];
                    @endphp
                    @foreach ($sampleStates as $stateName)
                        <a href="/{{ Str::slug($stateName) }}"
                            class="bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-sm font-medium hover:border-blue-300 hover:text-blue-700 hover:shadow-sm transition-all">
                            {{ $stateName }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
