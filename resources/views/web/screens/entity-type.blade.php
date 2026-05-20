@extends('web.layouts.app')

@section('title', $entityType->seo_title ?? $entityType->name . ' Requirements – StateFilingDeadlines')

@section('meta_description', $entityType->seo_description ?? 'Learn how to form, register, and maintain a ' .
    $entityType->name . ' in any state.')

@section('meta_keywords', $entityType->seo_keywords ?? strtolower($entityType->name) . ' formation, ' .
    strtolower($entityType->name) . ' requirements, ' . strtolower($entityType->name) . ' filing')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
        </path>
    </svg>
    Entity Type Guide
@endsection

@section('page_title', $entityType->name . ' Requirements')

@section('page_subtitle', 'Learn how to form, register, and maintain a ' . $entityType->name . ' in any state.')

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

    <!-- ENTITY OVERVIEW -->
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
                    <h2 class="text-3xl font-bold text-gray-900">What Is a {{ $entityType->name }}?</h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $entityType->description ?? 'A ' . $entityType->name . ' is a business structure that offers specific benefits, liability protection, and tax treatment for business owners.' }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Liability Protection</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Personal assets are protected from business debts
                            and liabilities.</p>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Tax Benefits</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Flexible tax treatment with potential pass-through
                            taxation and deductions.</p>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-purple-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Credibility</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Established business structure that builds trust
                            with customers and partners.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATE REQUIREMENTS -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">State Requirements for {{ $entityType->name }}</h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    Requirements vary depending on the state where you form your {{ $entityType->name }}.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    @forelse($states as $state)
                        <a href="{{ route('web.state-detail', $state->state_slug) }}"
                            class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow group">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span
                                    class="text-blue-700 text-sm font-bold group-hover:scale-110 transition-transform">{{ $state->state_name[0] }}</span>
                            </div>
                            <div>
                                <span
                                    class="text-gray-700 font-medium group-hover:text-blue-600 transition-colors">{{ $state->state_name }}</span>
                                @if ($state->filing_fee > 0)
                                    <span class="text-xs text-gray-400 block">Filing fee:
                                        ${{ number_format($state->filing_fee, 0) }}</span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-8 text-gray-500">No states available yet.</div>
                    @endforelse
                </div>

                <div class="mt-8">
                    <a href="{{ route('web.states') }}"
                        class="inline-flex items-center gap-2 bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        View All States
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- COMPLIANCE REQUIREMENTS -->
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
                    <h2 class="text-3xl font-bold text-gray-900">{{ $entityType->name }} Annual Compliance Requirements
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">1</span>
                        </div>
                        <span class="text-gray-700">Annual report filing</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">2</span>
                        </div>
                        <span class="text-gray-700">Franchise tax payments</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">3</span>
                        </div>
                        <span class="text-gray-700">Maintaining a registered agent</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">4</span>
                        </div>
                        <span class="text-gray-700">Keeping internal records updated</span>
                    </div>
                </div>
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
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Start Your {{ $entityType->name }} for $0 +
                    State Fees</h2>
                <p class="text-lg text-blue-200 mb-8 max-w-xl mx-auto">Recommended partner for fast, affordable business
                    formation.</p>
                <a href="/start-llc"
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
