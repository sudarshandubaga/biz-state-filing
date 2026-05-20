@extends('web.layouts.app')

@section('title', $industry->seo_title ?? $industry->name . ' Business Requirements – StateFilingDeadlines')

@section('meta_description',
    $industry->seo_description ??
    'Licensing, permits, taxes, and compliance requirements for
    operating a ' .
    $industry->name .
    ' business.')

@section('meta_keywords', $industry->seo_keywords ?? strtolower($industry->name) . ' business, ' .
    strtolower($industry->name) . ' license, ' . strtolower($industry->name) . ' permits, ' . strtolower($industry->name) .
    ' requirements')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
        </path>
    </svg>
    Industry Guide
@endsection

@section('page_title', $industry->name . ' Business Requirements')

@section('page_subtitle', 'Licensing, permits, taxes, and compliance requirements for operating a ' . $industry->name .
    ' business.')

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

    <!-- INDUSTRY OVERVIEW -->
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
                    <h2 class="text-3xl font-bold text-gray-900">About the {{ $industry->name }} Industry</h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $industry->description ?? 'The ' . $industry->name . ' industry has specific licensing, regulatory, and compliance requirements that vary by state and locality.' }}
                </p>
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
                    <h2 class="text-3xl font-bold text-gray-900">State Requirements for {{ $industry->name }} Businesses
                    </h2>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-5 mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-800"><strong>State-level licensing may be required.</strong>
                            Requirements vary depending on the type of {{ $industry->name }} business you operate.</p>
                    </div>
                </div>

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
                                @if ($state->state_name)
                                    <span class="text-xs text-gray-400 block">Business requirements & compliance</span>
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

    <!-- LICENSING & PERMITS -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $industry->name }} Licensing & Permits</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">1</span>
                        </div>
                        <span class="text-gray-700">General business license</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">2</span>
                        </div>
                        <span class="text-gray-700">Industry-specific permits</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">3</span>
                        </div>
                        <span class="text-gray-700">Health or safety inspections</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-700 text-sm font-bold">4</span>
                        </div>
                        <span class="text-gray-700">Environmental permits (if applicable)</span>
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
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Start Your {{ $industry->name }} Business for
                    $0 + State Fees</h2>
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
