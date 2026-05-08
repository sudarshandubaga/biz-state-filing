@extends('web.layouts.app')

@section('title', 'Business Filing Deadlines by State – StateFilingDeadlines')

@section('meta_description', 'Find business formation, annual report, and compliance filing deadlines for every US
    state.')

@section('meta_keywords', 'state business filing, state filing deadlines, business formation by state, LLC filing,
    annual report deadlines')

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
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                        </path>
                    </svg>
                    States
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    Business Filing Deadlines by State
                </h1>
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto">
                    Find business formation, annual report, and compliance filing deadlines for every US state.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- STATES GRID -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">All States</h2>
                    <span class="text-gray-500">{{ $states->total() }} states</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($states as $state)
                        <a href="{{ route('web.state-detail', $state->state_slug) }}" class="block group">
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full transition-all duration-300 group-hover:shadow-lg group-hover:border-blue-200">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3
                                            class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $state->state_name }}
                                        </h3>
                                        <p class="text-gray-500 mt-2 text-sm">
                                            {{ $state->filing_name ?? 'Business formation, annual reports & compliance' }}
                                        </p>
                                        @if ($state->filing_fee > 0)
                                            <p class="text-blue-600 font-semibold mt-2 text-sm">Filing fee:
                                                ${{ number_format($state->filing_fee, 0) }}</p>
                                        @endif
                                    </div>
                                    <svg class="w-6 h-6 text-gray-300 group-hover:text-blue-500 transition-colors flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                                @if ($state->deadline_month && $state->deadline_day)
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <span class="inline-flex items-center gap-1 text-xs text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Annual deadline:
                                            {{ DateTime::createFromFormat('m', $state->deadline_month)->format('F') }}
                                            {{ $state->deadline_day }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500">
                            No states available yet.
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if ($states->hasPages())
                    <div class="mt-8">
                        {{ $states->links() }}
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
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Start Your LLC for $0 + State Fees</h2>
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
