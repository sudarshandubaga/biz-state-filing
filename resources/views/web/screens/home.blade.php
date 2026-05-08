@extends('web.layouts.app')

@section('title', 'Home')

@section('content')
    <section class="relative min-h-[500px] flex items-center">
        <img src="{{ asset('imgs/hero1.jpg') }}" alt="Business filing hero"
            class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-blue-900/40"></div>
        <div class="relative container mx-auto px-4 py-16">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                    Start & Manage Your Business in Any State
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl">
                    Filing deadlines, formation guides, licensing requirements, tax rules, and compliance — all in one
                    place.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('web.states') }}"
                        class="bg-white text-blue-900 font-semibold px-8 py-3 rounded-lg hover:bg-blue-50 transition duration-300 inline-flex items-center gap-2">
                        Browse States
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('web.industries') }}"
                        class="border-2 border-white text-white font-semibold px-8 py-3 rounded-lg hover:bg-white hover:text-blue-900 transition duration-300">
                        Explore Industries
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ADVERTISEMENT SECTION -->
    <section class="py-4">
        <div class="container mx-auto px-4">
            <div class="ad-box bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <strong class="text-gray-500">Advertisement</strong><br>
                <span class="text-gray-400">Your ad could be here — 728x90 banner</span>
            </div>
        </div>
    </section>

    <!-- POPULAR STATES -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Popular States</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($states as $state)
                    <a href="{{ route('web.state-detail', $state->state_slug) }}" class="block group">
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full transition-all duration-300 group-hover:shadow-lg group-hover:border-blue-200">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $state->state_name }}
                                    </h3>
                                    <p class="text-gray-500 mt-2">Start an LLC, corporation, or business in
                                        {{ $state->state_name }}.</p>
                                </div>
                                <svg class="w-6 h-6 text-gray-300 group-hover:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500">
                        No states available yet.
                    </div>
                @endforelse
            </div>
            @if ($states->count() > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('web.states') }}"
                        class="inline-flex items-center gap-2 text-blue-800 font-semibold hover:text-blue-600 transition-colors">
                        View All States
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- ENTITY TYPES -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Entity Types</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($entityTypes as $entityType)
                    <a href="{{ route('web.entity-type-detail', $entityType->slug) }}" class="block group">
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full transition-all duration-300 group-hover:shadow-lg group-hover:border-blue-200">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors">
                                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $entityType->name }}</h3>
                            <p class="text-gray-500 mt-2 text-sm">
                                {{ $entityType->description ? Str::limit($entityType->description, 80) : $entityType->name . ' formation guides.' }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500">
                        No entity types available yet.
                    </div>
                @endforelse
            </div>
            @if ($entityTypes->count() > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('web.entity-types') }}"
                        class="inline-flex items-center gap-2 text-blue-800 font-semibold hover:text-blue-600 transition-colors">
                        View All Entity Types
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- INDUSTRIES -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Popular Industries</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($industries as $industry)
                    <a href="{{ route('web.industry-detail', $industry->slug) }}" class="block group">
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full transition-all duration-300 group-hover:shadow-lg group-hover:border-blue-200">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $industry->name }}
                                    </h3>
                                    <p class="text-gray-500 mt-2">
                                        {{ $industry->description ? Str::limit($industry->description, 60) : 'Licensing, permits, and startup requirements.' }}
                                    </p>
                                </div>
                                <svg class="w-6 h-6 text-gray-300 group-hover:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-8 text-gray-500">
                        No industries available yet.
                    </div>
                @endforelse
            </div>
            @if ($industries->count() > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('web.industries') }}"
                        class="inline-flex items-center gap-2 text-blue-800 font-semibold hover:text-blue-600 transition-colors">
                        View All Industries
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- AFFILIATE CTA -->
    <section class="py-16 bg-blue-800 text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Start Your LLC for $0 + State Fees</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto text-lg">Recommended partner for fast, affordable business
                formation.</p>
            <a href="/start-llc"
                class="inline-block bg-white text-blue-800 font-bold px-8 py-4 rounded-lg hover:bg-blue-50 transition duration-300 shadow-lg hover:shadow-xl">
                Start Now
            </a>
        </div>
    </section>

    <!-- ADVERTISEMENT SECTION -->
    <section class="py-4">
        <div class="container mx-auto px-4">
            <div class="ad-box bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <strong class="text-gray-500">Advertisement</strong><br>
                <span class="text-gray-400">Your ad could be here — 300x250 sidebar or inline block</span>
            </div>
        </div>
    </section>
@endsection
