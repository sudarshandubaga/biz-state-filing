@extends('web.layouts.app')

@section('title', 'Business Entity Types – LLC, Corporation, Nonprofit & More – StateFilingDeadlines')

@section('meta_description', 'Compare LLC, Corporation, Nonprofit, DBA and other business entity types. Learn formation
    requirements, costs, and compliance for each.')

@section('meta_keywords', 'business entity types, LLC, corporation, nonprofit, DBA, sole proprietorship, partnership,
    business structure')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative min-h-[300px] flex items-center bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE4YzEuNjU3IDAgMy0xLjM0MyAzLTNzLTEuMzQzLTMtMy0zLTMgMS4zNDMtMyAzIDEuMzQzIDMgMyAzem0wIDM2YzEuNjU3IDAgMy0xLjM0MyAzLTNzLTEuMzQzLTMtMy0zLTMgMS4zNDMtMyAzIDEuMzQzIDMgMyAzek0xOCAzNmMxLjY1NyAwIDMtMS4zNDMgMy0zcy0xLjM0My0zLTMtMy0zIDEuMzQzLTMgMyAxLjM0MyAzIDMgM3oiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30">
        </div>
        <div class="relative container mx-auto px-4 py-16">
            <div class="max-w-3xl mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-sm font-medium px-4 py-2 rounded-full mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Entity Types
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    Business Entity Types
                </h1>
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto">
                    Compare LLC, Corporation, Nonprofit, DBA and other business entity types. Learn which structure is right
                    for you.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- ENTITY TYPES GRID -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">All Entity Types</h2>
                    <span class="text-gray-500">{{ $entityTypes->total() }} entity types</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($entityTypes as $entityType)
                        <a href="{{ route('web.entity-type-detail', $entityType->slug) }}" class="block group">
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full transition-all duration-300 group-hover:shadow-lg group-hover:border-blue-200">
                                <div
                                    class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors">
                                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                    {{ $entityType->name }}</h3>
                                <p class="text-gray-500 mt-2 text-sm">
                                    {{ $entityType->description ?? 'Learn about ' . $entityType->name . ' formation, requirements, and compliance.' }}
                                </p>
                                @if ($entityType->seo_title)
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <span class="inline-flex items-center gap-1 text-xs text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ Str::limit($entityType->seo_title, 60) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500">
                            No entity types available yet.
                        </div>
                    @endforelse
                </div>

                @if ($entityTypes->hasPages())
                    <div class="mt-8">
                        {{ $entityTypes->links() }}
                    </div>
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
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Start Your Business for $0 + State Fees</h2>
                <p class="text-lg text-blue-200 mb-8 max-w-xl mx-auto">Recommended partner for fast, affordable business
                    formation.</p>
                <a href="/start-llc"
                    class="inline-flex items-center gap-2 bg-white text-blue-900 font-bold px-8 py-4 rounded-lg hover:bg-blue-50 transition-colors shadow-xl">
                    Start Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
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
