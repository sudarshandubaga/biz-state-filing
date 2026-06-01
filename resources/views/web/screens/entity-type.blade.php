@extends('web.layouts.app')

@section('title', $entityType->seo_title ?? ($entityType->label ?? $entityType->name) . ' Guide – BizStateFiling')

@section('meta_description', $entityType->seo_description ?? 'Learn how to form, register, and maintain a ' .
    ($entityType->label ?? $entityType->name) . ' in any state.')

@section('meta_keywords', $entityType->seo_keywords ?? strtolower($entityType->name) . ' formation, ' .
    strtolower($entityType->name) . ' requirements')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
        </path>
    </svg>
    Entity Type Guide
@endsection

@section('page_title', $entityType->headline ?? ($entityType->label ?? $entityType->name) . ' Guide')

@section('page_subtitle', $entityType->sub_headline ?? 'Learn how to form, register, and maintain a ' .
    ($entityType->label ?? $entityType->name) . ' in any state.')

@section('content')

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --dark: #0f172a;
            --text: #334155;
            --muted: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }

        .entity-section-title {
            font-size: 38px;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -1px;
            margin-bottom: 18px;
        }

        @media (max-width: 768px) {
            .entity-section-title {
                font-size: 30px;
            }
        }

        .entity-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .04);
        }

        .feature-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 28px;
            transition: .25s ease;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .04);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        }

        .feature-icon {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            font-size: 26px;
            color: var(--primary);
            margin-bottom: 22px;
        }

        .feature-card h4 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 14px;
            color: var(--dark);
        }

        .feature-card p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 0;
        }

        .warning-card {
            background: #fff7ed;
            border: 1px solid #fed7aa;
        }

        .warning-card .feature-icon {
            background: #ffedd5;
            color: #ea580c;
        }

        .quick-facts-card {
            background: #ffffff;
            border: 1px solid #dbeafe;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 20px 50px rgba(37, 99, 235, .08);
        }

        .quick-facts-card h5 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 22px;
            color: var(--dark);
        }

        .quick-facts-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .quick-facts-list li {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid #eef2ff;
            font-size: 14px;
            color: var(--text);
        }

        .quick-facts-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .quick-facts-list span {
            font-weight: 700;
            color: var(--dark);
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            left: 8px;
            width: 3px;
            height: 100%;
            background: #dbeafe;
        }

        .timeline-step {
            position: relative;
            padding-bottom: 34px;
        }

        .timeline-step:last-child {
            padding-bottom: 0;
        }

        .timeline-step:before {
            content: '';
            position: absolute;
            left: -30px;
            top: 4px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--primary);
            border: 4px solid #dbeafe;
        }

        .timeline-step h5 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .timeline-step p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 0;
        }

        .comparison-table {
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--border);
            background: #fff;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .04);
        }

        .comparison-table table {
            margin: 0;
        }

        .comparison-table thead {
            background: #eff6ff;
        }

        .comparison-table th {
            padding: 18px;
            font-size: 14px;
            font-weight: 800;
            color: var(--dark);
            border: none;
        }

        .comparison-table td {
            padding: 18px;
            font-size: 14px;
            color: var(--text);
            vertical-align: middle;
            border-color: #eef2ff;
        }

        .checklist {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .checklist li {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #eef2ff;
            font-size: 15px;
            line-height: 1.8;
            color: var(--text);
        }

        .checklist li:last-child {
            border-bottom: none;
        }

        .checklist i {
            color: #16a34a;
            font-size: 18px;
            margin-top: 2px;
        }

        .cta-gradient {
            background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
            border-radius: 32px;
            padding: 60px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .cta-gradient h2 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 18px;
        }

        .cta-gradient p {
            font-size: 17px;
            line-height: 1.9;
            color: rgba(255, 255, 255, .88);
            max-width: 760px;
        }

        .cta-light-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 24px;
            background: #fff;
            color: var(--primary);
            font-weight: 700;
            border-radius: 16px;
            text-decoration: none;
        }

        .cta-outline-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 24px;
            border: 1px solid rgba(255, 255, 255, .25);
            color: #fff;
            font-weight: 700;
            border-radius: 16px;
            text-decoration: none;
        }

        .cta-light-btn:hover,
        .cta-outline-btn:hover {
            opacity: .9;
            color: inherit;
        }
    </style>

    <div class="container mx-auto px-4 py-10">

        <!-- Hero Section -->
        <section
            class="bg-gradient-to-br from-blue-50 via-white to-white border border-gray-200 rounded-[32px] p-8 md:p-12 relative overflow-hidden mb-12">
            <div class="absolute top-[-120px] right-[-120px] w-80 h-80 bg-blue-500/10 rounded-full"></div>
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div class="flex-1">
                    <nav class="text-sm mb-4">
                        <a href="{{ route('home') }}"
                            class="text-blue-600 font-semibold no-underline hover:underline">Home</a>
                        <span class="text-gray-400 mx-2">/</span>
                        <a href="{{ route('web.entity-types') }}"
                            class="text-blue-600 font-semibold no-underline hover:underline">Entity Types</a>
                        <span class="text-gray-400 mx-2">/</span>
                        <span class="text-gray-500">{{ $entityType->label ?? $entityType->name }}</span>
                    </nav>
                    <h1
                        class="text-[38px] md:text-[52px] font-extrabold text-gray-900 leading-[1.1] tracking-tight mb-6 max-w-[760px]">
                        {{ $entityType->headline ?? ($entityType->label ?? $entityType->name) . ' Guide' }}
                    </h1>
                    <p class="text-lg md:text-xl leading-relaxed text-gray-500 max-w-[760px] mb-8">
                        {{ $entityType->sub_headline ?? ($entityType->short_description ?? 'Learn everything about ' . ($entityType->label ?? $entityType->name)) }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('formation.start') }}"
                            class="inline-flex items-center gap-2.5 px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl shadow-lg hover:-translate-y-0.5 transition-all no-underline">
                            <i class="fa-solid fa-building"></i> Start Your {{ $entityType->label ?? $entityType->name }}
                        </a>
                        @if (isset($entityTypes) && $entityTypes->count() > 0)
                            <a href="#comparison"
                                class="inline-flex items-center gap-2.5 px-6 py-4 bg-white border border-gray-200 text-gray-900 font-bold rounded-2xl hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 transition-all no-underline">
                                <i class="fa-solid fa-diagram-project"></i> Compare Structural Profiles
                            </a>
                        @endif
                    </div>
                </div>
                <div class="lg:w-80 flex-shrink-0 w-full">
                    <div class="quick-facts-card">
                        <h5>{{ $entityType->label ?? $entityType->name }} Quick Facts</h5>
                        <ul class="quick-facts-list">
                            <li><span>Liability Protection</span>
                                <div>{{ $entityType->liability_protection ?? 'Limited' }}</div>
                            </li>
                            <li><span>Taxation</span>
                                <div>{{ $entityType->taxation_type ?? 'Pass-through' }}</div>
                            </li>
                            <li><span>Ownership</span>
                                <div>{{ $entityType->ownership_structure ?? 'Members' }}</div>
                            </li>
                            <li><span>Best For</span>
                                <div>{{ $entityType->best_for_tagline ?? 'Small business owners' }}</div>
                            </li>
                            <li><span>Formation Cost</span>
                                <div>{{ $entityType->formation_cost_range ?? '$50 - $500' }}</div>
                            </li>
                            <li><span>Compliance Level</span>
                                <div>{{ $entityType->compliance_level ?? 'Low' }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-1 min-w-0">

                <!-- Definition -->
                <section id="definition">
                    <h2 class="entity-section-title">What Is a {{ $entityType->label ?? $entityType->name }}?</h2>
                    <div class="entity-card">
                        <p class="text-gray-500 leading-relaxed text-[17px]">
                            {{ $entityType->intro_content ?? ($entityType->description ?? 'A ' . ($entityType->label ?? $entityType->name) . ' is a business structure that offers specific benefits, liability protection, and tax treatment for business owners.') }}
                        </p>
                        @if ($entityType->not_recommended_for)
                            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-4 text-amber-800 text-sm">
                                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                                <strong>Not Ideal For:</strong> {{ $entityType->not_recommended_for }}
                            </div>
                        @endif
                    </div>
                </section>

                <!-- How It Works -->
                @php
                    $featuresData = is_array($entityType->features_data) ? $entityType->features_data : [];
                    $howWorks = collect($featuresData)->where('type', 'HOW_IT_WORKS');
                @endphp
                @if ($howWorks->count() > 0)
                    <section id="how-it-works" class="mt-16">
                        <h2 class="entity-section-title">How a {{ $entityType->label ?? $entityType->name }} Works</h2>
                        <p class="text-gray-500 leading-relaxed text-[17px] mb-6">{{ $entityType->description ?? '' }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($howWorks as $feat)
                                <div class="feature-card">
                                    <div class="feature-icon"><i
                                            class="fa-solid {{ $feat['icon_class'] ?? 'fa-gear' }}"></i></div>
                                    <h4>{{ $feat['title'] ?? '' }}</h4>
                                    <p>{{ $feat['description'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Advantages -->
                @php $advantages = collect($featuresData)->where('type', 'ADVANTAGE'); @endphp
                @if ($advantages->count() > 0)
                    <section id="advantages" class="mt-16">
                        <h2 class="entity-section-title">Advantages of a {{ $entityType->label ?? $entityType->name }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach ($advantages as $feat)
                                <div class="feature-card">
                                    <div class="feature-icon"><i
                                            class="fa-solid {{ $feat['icon_class'] ?? 'fa-check-circle' }}"></i></div>
                                    <h4>{{ $feat['title'] ?? '' }}</h4>
                                    <p>{{ $feat['description'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Disadvantages -->
                @php $disadvantages = collect($featuresData)->where('type', 'DISADVANTAGE'); @endphp
                @if ($disadvantages->count() > 0)
                    <section id="disadvantages" class="mt-16">
                        <h2 class="entity-section-title">Disadvantages of a {{ $entityType->label ?? $entityType->name }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($disadvantages as $feat)
                                <div class="feature-card warning-card">
                                    <div class="feature-icon"><i
                                            class="fa-solid {{ $feat['icon_class'] ?? 'fa-triangle-exclamation' }}"></i>
                                    </div>
                                    <h4>{{ $feat['title'] ?? '' }}</h4>
                                    <p>{{ $feat['description'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Tax Structure -->
                @if ($entityType->tax_deep_dive)
                    <section id="tax-profile" class="mt-16">
                        <h2 class="entity-section-title">{{ $entityType->label ?? $entityType->name }} Tax Structure</h2>
                        <div class="entity-card">
                            <p class="text-gray-500 leading-relaxed text-[17px]">{{ $entityType->tax_deep_dive }}</p>
                            @if ($entityType->tax_treatment_summary)
                                <div class="mt-4 bg-gray-50 rounded-2xl p-5">
                                    <h5 class="font-bold text-gray-900 mb-3">Default Tax Summaries & Frameworks</h5>
                                    <p class="text-gray-500 text-sm">{{ $entityType->tax_treatment_summary }}</p>
                                </div>
                            @endif
                        </div>
                    </section>
                @endif

                <!-- Formation Steps -->
                @php $steps = is_array($entityType->steps_data) ? $entityType->steps_data : []; @endphp
                @if (count($steps) > 0)
                    <section id="formation-steps" class="mt-16">
                        <h2 class="entity-section-title">Step-by-Step: How to Form</h2>
                        <div class="flex flex-col lg:flex-row gap-8">
                            <div class="flex-1">
                                <div class="timeline">
                                    @foreach ($steps as $index => $step)
                                        <div class="timeline-step">
                                            <h5>{{ $index + 1 }}. {{ $step['title'] ?? '' }}</h5>
                                            <p>{{ $step['description'] ?? '' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="lg:w-72 flex-shrink-0">
                                <div class="quick-facts-card h-full flex flex-col justify-center">
                                    <h5>Form Online Today</h5>
                                    <p class="text-gray-500 text-sm mb-4">Launch your new company with secure file
                                        processing, automated state checks, and real-time validation.</p>
                                    <a href="{{ route('formation.start') }}"
                                        class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl shadow-lg hover:-translate-y-0.5 transition-all no-underline text-center">
                                        Get Started Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

                <!-- Comparison Matrix -->
                @php $comparison = is_array($entityType->comparison_data) ? $entityType->comparison_data : []; @endphp
                @if (count($comparison) > 0 || (isset($entityTypes) && $entityTypes->count() > 0))
                    <section id="comparison" class="mt-16">
                        <h2 class="entity-section-title">Side-by-Side Structural Matrix</h2>
                        <div class="comparison-table overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th>Structure</th>
                                        <th>Liability Protection</th>
                                        <th>Tax Framework</th>
                                        <th>Complexity</th>
                                        <th>Ownership Type</th>
                                        <th>Primary Use Case</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($comparison) > 0)
                                        @foreach ($comparison as $row)
                                            <tr>
                                                <td><strong>{{ $row['label'] ?? '' }}</strong></td>
                                                <td>{{ $row['liability_protection'] ?? '' }}</td>
                                                <td>{{ $row['taxation_type'] ?? '' }}</td>
                                                <td>{{ $row['complexity_level'] ?? '' }}</td>
                                                <td>{{ $row['ownership_structure'] ?? '' }}</td>
                                                <td>{{ $row['best_for_tagline'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($entityTypes as $et)
                                            <tr>
                                                <td><strong>{{ $et->label ?? $et->name }}</strong></td>
                                                <td>{{ $et->liability_protection ?? 'Limited' }}</td>
                                                <td>{{ $et->taxation_type ?? 'Pass-through' }}</td>
                                                <td>{{ $et->complexity_level ?? 'Moderate' }}</td>
                                                <td>{{ $et->ownership_structure ?? 'Members' }}</td>
                                                <td>{{ $et->best_for_tagline ?? ($et->short_description ?? 'Various') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </section>
                @endif

                <!-- Compliance Rules -->
                @php $complianceRules = collect($featuresData)->where('type', 'COMPLIANCE_RULE'); @endphp
                @if ($complianceRules->count() > 0)
                    <section id="compliance-rules" class="mt-16">
                        <h2 class="entity-section-title">Ongoing Compliance Requirements</h2>
                        <div class="entity-card">
                            <ul class="checklist">
                                @foreach ($complianceRules as $feat)
                                    <li>
                                        <i class="fa-solid {{ $feat['icon_class'] ?? 'fa-check-circle' }} mt-0.5"></i>
                                        <div><strong>{{ $feat['title'] ?? '' }}:</strong> {{ $feat['description'] ?? '' }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif

                <!-- FAQs -->
                @php $faqs = is_array($entityType->faqs_data) ? $entityType->faqs_data : []; @endphp
                @if (count($faqs) > 0)
                    <section id="faq" class="mt-16">
                        <h2 class="entity-section-title">Frequently Asked Questions</h2>
                        <div class="space-y-4">
                            @foreach ($faqs as $index => $faq)
                                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                                    <button type="button"
                                        onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.fa-chevron-down').classList.toggle('rotate-180')"
                                        class="w-full flex items-center justify-between px-6 py-5 font-bold text-left text-gray-900 hover:bg-blue-50 transition-colors">
                                        <span>{{ $faq['question'] ?? '' }}</span>
                                        <svg class="w-4 h-4 text-blue-600 transition-transform flex-shrink-0"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div class="hidden px-6 pb-5 text-gray-500 text-[15px] leading-relaxed">
                                        {{ $faq['answer'] ?? '' }}</div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- CTA -->
                <section class="mt-16">
                    <div class="cta-gradient">
                        <h2>Establish Your {{ $entityType->label ?? $entityType->name }} Today</h2>
                        <p>Form your business using streamlined processing pipelines, real-time documentation tracking, and
                            compliance guides configured for your state.</p>
                        <div class="flex flex-wrap gap-4 mt-6">
                            <a href="{{ route('formation.start') }}" class="cta-light-btn"><i
                                    class="fa-solid fa-arrow-right-circle"></i> Start Formation</a>
                            <a href="{{ route('web.entity-types') }}" class="cta-outline-btn"><i
                                    class="fa-solid fa-diagram-project"></i> View All Entity Types</a>
                        </div>
                    </div>
                </section>

                <!-- States -->
                @if (isset($states) && $states->count() > 0)
                    <section class="mt-16">
                        <h2 class="entity-section-title">State Requirements for
                            {{ $entityType->label ?? $entityType->name }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($states as $state)
                                <a href="{{ route('web.state-detail', $state->state_slug) }}"
                                    class="flex items-center gap-3 bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md transition-all no-underline group">
                                    <div
                                        class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <span class="text-blue-700 text-sm font-bold">{{ $state->state_name[0] }}</span>
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
                            @endforeach
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('web.states') }}"
                                class="inline-flex items-center gap-2 bg-blue-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors no-underline">
                                View All States <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </section>
                @endif

            </div>

            <!-- Sidebar TOC -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <div class="sticky top-24 bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h6 class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-4">On This Page</h6>
                    <div class="space-y-1">
                        <a href="#definition"
                            class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Overview</a>
                        @if ($howWorks->count() > 0)
                            <a href="#how-it-works"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">How
                                It Works</a>
                        @endif
                        @if ($advantages->count() > 0)
                            <a href="#advantages"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Advantages</a>
                        @endif
                        @if ($disadvantages->count() > 0)
                            <a href="#disadvantages"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Disadvantages</a>
                        @endif
                        @if ($entityType->tax_deep_dive)
                            <a href="#tax-profile"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Tax
                                Treatment</a>
                        @endif
                        @if (count($steps) > 0)
                            <a href="#formation-steps"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Formation
                                Steps</a>
                        @endif
                        <a href="#comparison"
                            class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Compare
                            Matrix</a>
                        @if ($complianceRules->count() > 0)
                            <a href="#compliance-rules"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline border-b border-gray-100">Compliance</a>
                        @endif
                        @if (count($faqs) > 0)
                            <a href="#faq"
                                class="block py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 no-underline">FAQs</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ accordion toggle functionality 
            document.querySelectorAll('#faq button').forEach(btn => {
                btn.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('svg');
                    content.classList.toggle('hidden');
                    if (icon) icon.classList.toggle('rotate-180');
                });
            });
        });
    </script>
@endpush
