@php
    $naicsCode = $industry->naics_code ?? '000000';
    $difficulty = $industry->startup_difficulty ?? 'MEDIUM';
    $marginRange = $industry->profit_margin_range ?? '10% - 20%';
    $marketSize = $industry->market_size_estimate ?? 'Growing Market Sector';
    $typicalEntityLabel = 'LLC';
    $affiliateUrl = route('formation.start') . '?source=sfd-industry-' . ($industry->slug ?? 'business');
@endphp

@extends('web.layouts.app')

@section('title', $industry->seo_title ?? $industry->name . ' Business Requirements – BizStateFiling')

@section('meta_description', $industry->seo_description ?? 'Step-by-step business verification frameworks for the ' .
    $industry->name . ' industry. Learn about mandatory state licenses, taxes, and local regulations.')

@section('meta_keywords', $industry->seo_keywords ?? strtolower($industry->name) . ' business, ' .
    strtolower($industry->name) . ' license, ' . strtolower($industry->name) . ' permits')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
        </path>
    </svg>
    Industry Guide
@endsection

@section('page_title', $industry->name . ' Business Requirements')
@section('page_subtitle', 'Comprehensive compliance parameters, state deadlines, structures, and foundational
    operational license rules.')

@section('content')
    <style>
        .industry-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 65px 0;
            color: #ffffff;
        }

        .industry-section-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }

        .industry-section-title {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .industry-metric-badge {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .difficulty-LOW {
            color: #15803d;
            background: #dcfce7;
            border-color: #bbf7d0;
            font-weight: 600;
        }

        .difficulty-MEDIUM {
            color: #b45309;
            background: #fef3c7;
            border-color: #fde68a;
            font-weight: 600;
        }

        .difficulty-HIGH {
            color: #b91c1c;
            background: #fee2e2;
            border-color: #fca5a5;
            font-weight: 600;
        }

        .industry-requirement-item {
            border-left: 3px solid #3b82f6;
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 12px;
        }

        .industry-ecosystem-banner {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
            border-radius: 12px;
        }

        .industry-ad-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            color: #64748b;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
    </style>

    <!-- ============================================
    HERO SECTION
    ============================================ -->
    <header class="industry-hero">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-6">
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-block bg-blue-600 text-white text-sm font-semibold px-3 py-1.5 rounded-md mb-3">
                        NAICS Code: {{ $naicsCode }}
                    </span>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-3">
                        {{ $industry->name }} Business Requirements
                    </h1>
                    <p class="text-lg text-white/70 max-w-2xl">
                        Comprehensive compliance parameters, state deadlines, structures, and foundational operational
                        license rules.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ $affiliateUrl }}"
                        class="inline-flex items-center gap-2 bg-white text-blue-900 font-bold px-6 py-3.5 rounded-lg hover:bg-blue-50 transition-all shadow-xl text-lg">
                        <i class="fa-solid fa-rocket"></i>
                        Register Your {{ $typicalEntityLabel }}
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ============================================
    ADVERTISEMENT BANNER
    ============================================ -->
    <section class="py-6">
        <div class="container mx-auto px-4">
            <div class="industry-ad-box max-w-full">728x90 Programmatic Banner Placement</div>
        </div>
    </section>

    <!-- ============================================
    MAIN CONTENT
    ============================================ -->
    <main class="py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- ============================================
                PRIMARY CONTENT
                ============================================ -->
                <div class="flex-1 min-w-0">

                    <!-- COHESIVE META BADGES GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="industry-metric-badge flex flex-col items-center justify-center text-center h-full">
                            <span class="text-gray-500 text-xs uppercase font-semibold mb-1">Filing Complexity</span>
                            <span
                                class="badge px-3 py-1.5 rounded-md difficulty-{{ $difficulty }}">{{ $difficulty }}</span>
                        </div>
                        <div class="industry-metric-badge flex flex-col items-center justify-center text-center h-full">
                            <span class="text-gray-500 text-xs uppercase font-semibold mb-1">Average Profit Margin</span>
                            <span class="font-bold text-gray-900 text-lg">{{ $marginRange }}</span>
                        </div>
                        <div class="industry-metric-badge flex flex-col items-center justify-center text-center h-full">
                            <span class="text-gray-500 text-xs uppercase font-semibold mb-1">Market Scope</span>
                            <span class="font-semibold text-gray-600 text-sm">{{ $marketSize }}</span>
                        </div>
                    </div>

                    <!-- CORE DESCRIPTION -->
                    <div class="industry-section-card">
                        <h2 class="industry-section-title">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Industry Overview
                        </h2>
                        <div class="text-gray-600 leading-relaxed">
                            {{ $industry->description ?? 'The ' . $industry->name . ' industry has specific licensing, regulatory, and compliance requirements that vary by state and locality.' }}
                        </div>
                    </div>

                    <!-- FEDERAL REQUIREMENTS -->
                    <div class="industry-section-card">
                        <h2 class="industry-section-title">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                                </path>
                            </svg>
                            Federal Pre-requisites & Operating Authorities
                        </h2>
                        <p class="text-gray-500 text-sm mb-4">Standard federal requirements for operating a
                            {{ $industry->name }} business.</p>
                        <div>
                            <div class="industry-requirement-item">
                                <h5 class="font-bold text-gray-900 mb-1">Employer Identification Number (EIN)</h5>
                                <p class="text-gray-500 text-sm mb-2">Issuing Authority: <strong>Internal Revenue Service
                                        (IRS)</strong></p>
                                <p class="text-gray-400 text-sm mb-0">Required for hiring employees, opening business bank
                                    accounts, and filing business tax returns.</p>
                            </div>
                            <div class="industry-requirement-item">
                                <h5 class="font-bold text-gray-900 mb-1">Business Tax Registrations</h5>
                                <p class="text-gray-500 text-sm mb-2">Issuing Authority: <strong>IRS & State Revenue
                                        Departments</strong></p>
                                <p class="text-gray-400 text-sm mb-0">Federal and state tax registration for income tax,
                                    employment tax, and applicable excise taxes.</p>
                            </div>
                        </div>
                    </div>

                    <!-- STATE LICENSING -->
                    <div class="industry-section-card">
                        <h2 class="industry-section-title">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>
                            State Licensing & Mandated Tax Profile Settings
                        </h2>
                        <p class="text-gray-500 text-sm mb-4">Requirements map below for the standard configuration
                            frameworks. Select a state to see detailed requirements.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @forelse($states as $state)
                                <a href="{{ route('web.state-detail', $state->state_slug) }}"
                                    class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-3.5 hover:shadow-md hover:border-blue-200 transition-all group no-underline">
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="text-blue-700 text-xs font-bold group-hover:scale-110 transition-transform">{{ substr($state->state_name, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <span
                                            class="text-gray-700 font-medium text-sm group-hover:text-blue-600 transition-colors">{{ $state->state_name }}</span>
                                        <span class="text-xs text-gray-400 block">Business licensing & compliance</span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gray-500 text-sm col-span-full">Review your home state registration tracking
                                    page for standard regional certifications.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- RECOMMENDED ENTITY TYPES -->
                    @if (isset($entityTypes) && $entityTypes->count() > 0)
                        <div class="industry-section-card">
                            <h2 class="industry-section-title">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Recommended Business Structures
                            </h2>
                            <p class="text-gray-500 text-sm mb-4">The best entity types for a {{ $industry->name }}
                                business.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($entityTypes->take(4) as $et)
                                    <a href="{{ route('web.entity-type-detail', $et->slug) }}"
                                        class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md hover:border-blue-200 transition-all group no-underline">
                                        @if ($et->icon)
                                            <i class="fas {{ $et->icon }} text-2xl text-blue-600 w-8 text-center"></i>
                                        @else
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                                <span
                                                    class="text-blue-700 text-xs font-bold">{{ substr($et->name, 0, 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <span
                                                class="text-gray-900 font-semibold text-sm group-hover:text-blue-600 transition-colors">{{ $et->name }}</span>
                                            @if ($et->short_description)
                                                <p class="text-xs text-gray-400 mt-0.5">{{ $et->short_description }}</p>
                                            @endif
                                        </div>
                                        <svg class="w-4 h-4 text-gray-300 group-hover:text-blue-500 transition-colors flex-shrink-0"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- HOW TO START SECTION -->
                    <div class="industry-section-card">
                        <h2 class="industry-section-title">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            How to Start Your {{ $industry->name }} Business
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-blue-700 text-sm font-bold">1</span>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900">Choose Your Business Structure</h5>
                                    <p class="text-gray-500 text-sm">Decide between an LLC, Corporation, or Sole
                                        Proprietorship based on your liability and tax needs.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-blue-700 text-sm font-bold">2</span>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900">Register Your Business</h5>
                                    <p class="text-gray-500 text-sm">File the necessary formation documents with your state
                                        and obtain your EIN from the IRS.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-blue-700 text-sm font-bold">3</span>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900">Obtain Licenses & Permits</h5>
                                    <p class="text-gray-500 text-sm">Apply for the specific business licenses, health
                                        permits, and industry certifications required in your state and locality.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-blue-700 text-sm font-bold">4</span>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900">Stay Compliant</h5>
                                    <p class="text-gray-500 text-sm">Keep up with annual reports, tax filings, license
                                        renewals, and regulatory changes specific to your industry.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LICENSING & PERMITS -->
                    <div class="industry-section-card">
                        <h2 class="industry-section-title">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                            {{ $industry->name }} Licensing & Permits
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-3.5">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-700 text-sm font-bold">1</span>
                                </div>
                                <span class="text-gray-700 text-sm">General business license</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-3.5">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-700 text-sm font-bold">2</span>
                                </div>
                                <span class="text-gray-700 text-sm">Industry-specific permits</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-3.5">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-700 text-sm font-bold">3</span>
                                </div>
                                <span class="text-gray-700 text-sm">Health or safety inspections</span>
                            </div>
                            <div class="flex items-center gap-3 bg-white rounded-lg border border-gray-200 p-3.5">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-blue-700 text-sm font-bold">4</span>
                                </div>
                                <span class="text-gray-700 text-sm">Environmental permits (if applicable)</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ============================================
                RIGHT RAIL SIDEBAR
                ============================================ -->
                <div class="w-full lg:w-80 flex-shrink-0">

                    <!-- STICKY CONVERSION CARD -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center mb-6 lg:sticky lg:top-24">
                        <h5 class="font-bold text-gray-900 mb-2">Form Your Business Legally</h5>
                        <p class="text-gray-500 text-sm mb-4">Launch your new <strong>{{ $industry->name }}</strong>
                            structure safely with our automated fulfillment partner.</p>

                        <div class="bg-gray-50 rounded-lg p-4 text-start mb-4">
                            <div class="flex justify-between border-b border-gray-200 pb-2 mb-2 text-sm text-gray-500">
                                <span>Structure:</span>
                                <strong class="text-gray-900">{{ $typicalEntityLabel }}</strong>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Filing Cost:</span>
                                <strong class="text-green-600">$0 + State Fees</strong>
                            </div>
                        </div>

                        <a href="{{ $affiliateUrl }}"
                            class="inline-flex items-center justify-center gap-2 w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold px-5 py-3.5 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all shadow-md mb-3">
                            <i class="fa-solid fa-rocket"></i>
                            Start Your {{ $typicalEntityLabel }} Now
                        </a>
                        <span class="text-gray-400 text-xs uppercase tracking-wider block">Official Partner Process</span>
                    </div>

                    <!-- AD PLACEMENT -->
                    <div class="industry-ad-box py-8 mb-6">300x250 Display Ad</div>

                </div>
            </div>
        </div>
    </main>

    <!-- ============================================
    CALL TO ACTION BANNER
    ============================================ -->
    <section class="py-14 bg-gradient-to-r from-blue-800 to-indigo-800 mt-8">
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
                <a href="{{ $affiliateUrl }}"
                    class="inline-flex items-center gap-2 bg-white text-blue-900 font-bold px-8 py-4 rounded-lg hover:bg-blue-50 transition-colors shadow-xl text-lg no-underline">
                    Start Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- AD SECTION -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="industry-ad-box max-w-md mx-auto py-8">300x250 Ad Placement</div>
        </div>
    </section>
@endsection
