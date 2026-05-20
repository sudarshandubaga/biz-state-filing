@extends('web.layouts.app')

@section('title', 'Business Industries – Licensing & Compliance by Industry – StateFilingDeadlines')

@section('meta_description',
    'Find licensing, permits, taxes, and compliance requirements for your industry. Restaurant,
    Trucking, Real Estate, Cleaning and more.')

@section('meta_keywords',
    'business industries, industry requirements, business license by industry, industry permits,
    industry compliance')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
        </path>
    </svg>
    Industries
@endsection

@section('page_title', 'Business Industries')

@section('page_subtitle', 'Find licensing, permits, taxes, and compliance requirements for your industry.')

@section('content')
    <!-- INDUSTRIES GRID -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">All Industries</h2>
                    <span class="text-gray-500">{{ $industries->total() }} industries</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($industries as $industry)
                        <a href="{{ route('web.industry-detail', $industry->slug) }}" class="block group">
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 h-full transition-all duration-300 group-hover:shadow-lg group-hover:border-blue-200">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3
                                            class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $industry->name }}
                                        </h3>
                                        <p class="text-gray-500 mt-2 text-sm">
                                            {{ $industry->description ?? 'Licensing, permits, taxes, and compliance requirements.' }}
                                        </p>
                                    </div>
                                    <svg class="w-6 h-6 text-gray-300 group-hover:text-blue-500 transition-colors flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12 text-gray-500">
                            No industries available yet.
                        </div>
                    @endforelse
                </div>

                @if ($industries->hasPages())
                    <div class="mt-8">
                        {{ $industries->links() }}
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
