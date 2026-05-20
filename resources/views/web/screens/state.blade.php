@extends('web.layouts.app')

@section('title',
    $state->seo_title ??
    $state->state_name .
    ' Business Filing Deadlines & Requirements –
    StateFilingDeadlines')

@section('meta_description', $state->seo_description ?? 'Everything you need to start, manage, and stay compliant with '
    . $state->state_name . ' business regulations.')

@section('meta_keywords', $state->state_name . ' business filing, ' . $state->state_name . ' LLC, ' . $state->state_name
    . ' corporation, ' . $state->state_name . ' business license, ' . $state->state_name . ' annual report')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
        </path>
    </svg>
    State Guide
@endsection

@section('page_title', $state->state_name . ' Business Filing Deadlines & Requirements')

@section('page_subtitle', 'Everything you need to start, manage, and stay compliant with ' . $state->state_name . '
    business regulations.')

@section('content')

    <!-- ADVERTISEMENT SECTION -->
    <section class="py-6">
        <div class="container mx-auto px-4">
            <div
                class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-gray-300 transition-colors">
                <strong class="text-gray-400 text-sm uppercase tracking-wider">Advertisement</strong><br>
                <span class="text-gray-300 text-sm">728×90 Banner Ad Placement</span>
            </div>
        </div>
    </section>

    <!-- STATE OVERVIEW -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $state->state_name }} Overview</h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $state->filing_name ?? 'Learn about the business environment, key industries, and regulatory landscape in ' . $state->state_name . '.' }}
                </p>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                    <div
                        class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:shadow-md transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">${{ number_format($state->filing_fee, 0) }}</div>
                        <div class="text-sm text-gray-500 mt-1">Filing Fee</div>
                    </div>
                    <div
                        class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:shadow-md transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">{{ $state->report_required ? 'Yes' : 'No' }}</div>
                        <div class="text-sm text-gray-500 mt-1">Annual Report Required</div>
                    </div>
                    <div
                        class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:shadow-md transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">${{ number_format($state->late_fee, 0) }}</div>
                        <div class="text-sm text-gray-500 mt-1">Late Fee</div>
                    </div>
                    <div
                        class="bg-white rounded-xl border border-gray-200 p-4 text-center hover:shadow-md transition-shadow">
                        <div class="text-2xl font-bold text-blue-600">{{ $state->deadline_type ?? 'Fixed' }}</div>
                        <div class="text-sm text-gray-500 mt-1">Deadline Type</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW TO START A BUSINESS IN STATE -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">How to Start a Business in {{ $state->state_name }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="flex items-start gap-4 bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-700 font-bold">1</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Choose an Entity Type</h3>
                            <p class="text-sm text-gray-500 mt-1">Decide between LLC, Corporation, Nonprofit, or DBA based
                                on your needs.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start gap-4 bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-700 font-bold">2</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">File Formation Documents</h3>
                            <p class="text-sm text-gray-500 mt-1">Submit Articles of Organization or Incorporation with the
                                state.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start gap-4 bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-700 font-bold">3</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Obtain Licenses & Permits</h3>
                            <p class="text-sm text-gray-500 mt-1">Apply for required state and local business licenses.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start gap-4 bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-700 font-bold">4</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Register for Taxes</h3>
                            <p class="text-sm text-gray-500 mt-1">Get your EIN and register for state and local taxes.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start gap-4 bg-white rounded-xl p-5 border border-gray-200 hover:shadow-md transition-shadow md:col-span-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-blue-700 font-bold">5</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Meet Annual Requirements</h3>
                            <p class="text-sm text-gray-500 mt-1">File annual reports, pay franchise taxes, and maintain
                                compliance.</p>
                        </div>
                    </div>
                </div>

                @if ($state->affiliate_url)
                    <div class="mt-8 text-center">
                        <a href="{{ $state->affiliate_url }}" target="_blank"
                            class="inline-flex items-center gap-2 bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                            Start Your {{ $state->state_name }} Business
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ENTITY TYPES IN STATE -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Entity Types in {{ $state->state_name }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($entityTypes as $entityType)
                        <a href="{{ route('web.entity-type-detail', $entityType->slug) }}"
                            class="group block bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all hover:border-blue-200">
                            <div
                                class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors">
                                {{ $state->state_name }} {{ $entityType->name }}</h3>
                            <p class="text-gray-500 text-sm mt-2">Formation fees, processing times, and requirements for
                                forming a {{ $entityType->name }}.</p>
                            <span
                                class="inline-flex items-center gap-1 text-blue-600 text-sm font-medium mt-3 group-hover:gap-2 transition-all">
                                Learn More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-8 text-gray-500">No entity types available.</div>
                    @endforelse
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('web.entity-types') }}"
                        class="inline-flex items-center gap-2 bg-white text-blue-800 font-semibold px-6 py-3 rounded-lg border-2 border-blue-800 hover:bg-blue-800 hover:text-white transition-colors">
                        View All Entity Types
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- LICENSING REQUIREMENTS -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $state->state_name }} Business License Requirements
                    </h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    Most businesses in {{ $state->state_name }} need some form of licensing depending on their industry and
                    location.
                    {{ $state->compliance_agency ? 'The ' . $state->compliance_agency . ' oversees business compliance.' : '' }}
                </p>
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-5 mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-800">Requirements vary by city, county, and business type. Always check
                            with local authorities.</p>
                    </div>
                </div>

                @if ($state->portal_url)
                    <a href="{{ $state->portal_url }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-white text-blue-800 font-semibold px-6 py-3 rounded-lg border-2 border-blue-800 hover:bg-blue-800 hover:text-white transition-colors">
                        Visit {{ $state->state_name }} Business Portal
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ANNUAL DEADLINES -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $state->state_name }} Annual Filing Deadlines</h2>
                </div>

                @if ($state->deadline_month && $state->deadline_day)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-700 text-sm font-bold">1</span>
                            </div>
                            <span class="text-gray-700">Annual deadline:
                                {{ DateTime::createFromFormat('m', $state->deadline_month)->format('F') }}
                                {{ $state->deadline_day }}</span>
                        </div>
                        @if ($state->renewal_cycle)
                            <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-700 text-sm font-bold">2</span>
                                </div>
                                <span class="text-gray-700">Renewal cycle: {{ $state->renewal_cycle }}</span>
                            </div>
                        @endif
                        <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-700 text-sm font-bold">{{ $state->renewal_cycle ? 3 : 2 }}</span>
                            </div>
                            <span class="text-gray-700">Late fee: ${{ number_format($state->late_fee, 0) }}</span>
                        </div>
                    </div>
                @else
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        Stay on top of your annual compliance obligations in {{ $state->state_name }}.
                    </p>
                @endif

                <div class="bg-amber-50 border-l-4 border-amber-500 rounded-r-lg p-5 mb-6 mt-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <p class="text-sm text-amber-800">Missing annual filing deadlines can result in late fees,
                            penalties, or administrative dissolution.</p>
                    </div>
                </div>

                @if ($state->affiliate_url)
                    <a href="{{ $state->affiliate_url }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        Start Your {{ $state->state_name }} Business
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- AFFILIATE CTA -->
    <section class="py-16 bg-gradient-to-r from-blue-800 to-indigo-800">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/10 mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Start Your {{ $state->state_name }} LLC for $0
                    + State Fees</h2>
                <p class="text-lg text-blue-200 mb-8 max-w-xl mx-auto">Recommended partner for fast, affordable business
                    formation.</p>
                <a href="{{ $state->affiliate_url ?? '/start-llc' }}" target="_blank"
                    class="inline-flex items-center gap-2 bg-white text-blue-900 font-bold px-8 py-4 rounded-lg hover:bg-blue-50 transition-colors shadow-xl">
                    Start Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ADVERTISEMENT SECTION -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div
                class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-gray-300 transition-colors max-w-md mx-auto">
                <strong class="text-gray-400 text-sm uppercase tracking-wider">Advertisement</strong><br>
                <span class="text-gray-300 text-sm">300×250 Ad Placement</span>
            </div>
        </div>
    </section>
@endsection
