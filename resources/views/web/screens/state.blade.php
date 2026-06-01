@extends('web.layouts.app')

@section('title', $state->seo_title ?? 'Start a Business in ' . $state->state_name . ' - Business Filing & Compliance')

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

@section('page_title', $state->hero_heading ?? 'Start a Business in ' . $state->state_name)

@section('page_subtitle',
    $state->hero_subheading ??
    'From access to major industrial pipelines to straightforward
    administrative upkeep, ' .
    $state->state_name .
    ' offers a robust growth environment for corporate and LLC structures.
    Review core speed indicators, filing costs, and find out how to execute your formation through vetted industry
    partners.')

@section('content')

    <style>
        :root {
            --primary-color: #0f172a;
            --brand-blue: #2563eb;
            --accent-green: #16a34a;
            --text-main: #334155;
            --text-dark: #0f172a;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
            --radius: 12px;
        }

        .metrics-summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* repeat(auto-fit, minmax(340px, 1fr)); */
            gap: 20px;
            margin-bottom: 40px;
        }

        .metric-summary-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .metric-summary-card .label {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 4px;
        }

        .metric-summary-card .value {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .metric-summary-card .subtext {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 4px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .card-benefit {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 24px;
        }

        .card-benefit h3 {
            margin-top: 0;
            color: var(--text-dark);
            font-size: 1.25rem;
        }

        .data-table-wrapper {
            overflow-x: auto;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }

        .data-table th {
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-weight: 600;
            padding: 14px 16px;
            border-bottom: 2px solid var(--border-color);
        }

        .data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .sector-link {
            color: var(--brand-blue);
            font-weight: 600;
            text-decoration: none;
        }

        .sector-link:hover {
            text-decoration: underline;
        }

        .step-list {
            position: relative;
            margin-bottom: 40px;
            padding-left: 0;
            list-style: none;
        }

        .step-item {
            position: relative;
            padding-left: 45px;
            margin-bottom: 35px;
        }

        .step-item::before {
            content: attr(data-step);
            position: absolute;
            left: 0;
            top: 2px;
            width: 28px;
            height: 28px;
            background-color: var(--primary-color);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .step-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .partner-routing-block {
            background-color: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            margin: 16px 0;
            padding: 16px;
        }

        .partner-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .partner-row:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 550px) {
            .partner-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        .partner-info strong {
            color: var(--text-dark);
            font-size: 1.05rem;
        }

        .partner-info p {
            margin: 4px 0 0 0;
            font-size: 0.85rem;
            color: var(--text-main);
        }

        .affiliate-link {
            color: var(--accent-green);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
            border: 1px solid var(--accent-green);
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-block;
        }

        .affiliate-link:hover {
            background-color: var(--accent-green);
            color: #ffffff;
        }

        .faq-wrapper {
            margin-top: 30px;
        }

        .faq-item {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
            background-color: #ffffff;
        }

        .faq-question {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 10px 0;
        }

        .faq-answer {
            font-size: 0.95rem;
            color: var(--text-main);
            margin: 0;
        }

        .ecosystem-footer-panel {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid #bbf7d0;
            padding: 30px;
            border-radius: var(--radius);
            margin-top: 60px;
        }

        .ecosystem-footer-panel h3 {
            margin-top: 0;
            color: #166534;
        }

        .sidebar-states-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .sidebar-states-list::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-states-list::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .sidebar-states-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>

    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-1 min-w-0">

                <!-- CRITICAL FILE LOGISTICS (FEES & SPEED INDICATORS) -->
                <section>
                    <div class="metrics-summary-grid">
                        <div class="metric-summary-card" style="border-top: 4px solid var(--brand-blue);">
                            <div class="label">State Filing Fee</div>
                            <div class="value">${{ number_format($state->filing_fee, 2) }}</div>
                            <div class="subtext">One-time base formation cost</div>
                        </div>
                        <div class="metric-summary-card" style="border-top: 4px solid var(--accent-green);">
                            <div class="label">Standard Processing</div>
                            <div class="value">{{ $state->standard_processing_days ?? '5 - 20 Days' }}</div>
                            <div class="subtext">
                                {{ $state->standard_processing_label ?? ($state->compliance_agency ?? 'State processing queue') }}
                            </div>
                        </div>
                        <div class="metric-summary-card" style="border-top: 4px solid #f59e0b;">
                            <div class="label">Expedited Processing</div>
                            <div class="value">{{ $state->expedited_processing_text ?? 'Available' }}</div>
                            <div class="subtext">
                                {{ $state->expedited_processing_label ?? 'Available with additional fees' }}</div>
                        </div>
                        <div class="metric-summary-card" style="border-top: 4px solid #b91c1c;">
                            <div class="label">Annual LLC Fee</div>
                            <div class="value">${{ number_format($state->annual_llc_fee ?? 0, 2) }}</div>
                            <div class="subtext">
                                {{ $state->annual_llc_fee_label ?? ($state->report_required ? 'Recurring yearly fee' : 'No annual fee') }}
                            </div>
                        </div>
                    </div>
                </section>

                <!-- INLINE LEAD GENERATION ENGINE -->
                @if ($state->cta_heading || $state->affiliate_url)
                    <div
                        class="bg-white border-2 border-blue-500 rounded-xl p-8 shadow-lg mb-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                        <div class="cta-content">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                {{ $state->cta_heading ?? 'Ready to Register Your ' . $state->state_name . ' Entity?' }}
                            </h2>
                            <p class="text-gray-600">
                                {{ $state->cta_subheading ?? 'Skip the state administrative confusion. Access our top-rated legal partner integrations to complete your business registration.' }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ $state->affiliate_url ?? route('formation.start') }}" target="_blank"
                                class="inline-block bg-gradient-to-r from-blue-700 to-blue-600 text-white px-8 py-4 rounded-lg font-bold hover:from-blue-800 hover:to-blue-700 transition-all shadow-md hover:shadow-lg">Launch
                                Filing Wizard →</a>
                        </div>
                    </div>
                @endif

                <!-- STRATEGIC BENEFITS -->
                @php $benefits = $state->benefits_data; @endphp
                @if (!empty($benefits))
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">Strategic
                            Incentives for {{ $state->state_name }} Formations</h2>
                        <div class="grid-3">
                            @foreach ($benefits as $benefit)
                                <div class="card-benefit">
                                    <h3>{{ $benefit['title'] ?? '' }}</h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $benefit['description'] ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- INDUSTRY SECTORS TABLE -->
                @php $sectors = $state->industry_sectors_data; @endphp
                @if (!empty($sectors))
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">High-Growth
                            Industrial Landscapes in {{ $state->state_name }}</h2>
                        <p class="text-gray-600 mb-6">Forming an industry-specific entity inside {{ $state->state_name }}
                            requires mapping municipal code layouts and local demand patterns. Explore our deep guides on
                            top operational vertical landscapes:</p>
                        <div class="data-table-wrapper">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Target Industry Category</th>
                                        <th>Avg. Startup Cost</th>
                                        <th>Regulatory Overhead</th>
                                        <th>Market Growth (YoY)</th>
                                        <th>Deep Dive Guides</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sectors as $sector)
                                        <tr>
                                            <td><strong>{{ $sector['category'] ?? '' }}</strong></td>
                                            <td>{{ $sector['avg_cost'] ?? '' }}</td>
                                            <td>{{ $sector['regulatory_overhead'] ?? '' }}</td>
                                            <td>{{ $sector['growth'] ?? '' }}</td>
                                            <td><a href="{{ $sector['guide_link'] ?? route('web.industries') }}"
                                                    class="sector-link">{{ $sector['guide_text'] ?? 'View Guide' }} →</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                @endif

                <!-- EXECUTION BLUEPRINT -->
                @php $steps = $state->execution_steps_data; @endphp
                <section id="execution-blueprint">
                    <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">The Execution
                        Blueprint: Step-by-Step Pathway</h2>
                    @if (!empty($steps))
                        <ul class="step-list">
                            @foreach ($steps as $index => $step)
                                <li class="step-item" data-step="{{ $index + 1 }}">
                                    <div class="step-title">{{ $step['title'] ?? '' }}</div>
                                    <p class="text-gray-600 mb-4">{{ $step['description'] ?? '' }}</p>
                                    @if (!empty($step['partners']))
                                        <div class="partner-routing-block">
                                            @foreach ($step['partners'] as $partner)
                                                <div class="partner-row">
                                                    <div class="partner-info">
                                                        <strong>{{ $partner['name'] ?? '' }}</strong>
                                                        <p>{{ $partner['note'] ?? '' }}</p>
                                                    </div>
                                                    <a href="{{ $partner['url'] ?? '#' }}" target="_blank"
                                                        class="affiliate-link">{{ $partner['button_text'] ?? 'Learn More' }}
                                                        →</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600 mb-8">Rather than managing complex state paperwork manually, you can route
                            your setup steps through verified digital filing providers:</p>
                        <ul class="step-list">
                            <li class="step-item" data-step="1">
                                <div class="step-title">Structure and File Articles of Organization</div>
                                <p class="text-gray-600">Submit formal constitutional documents directly to the state filing
                                    agency. Standard processing times vary, but we advise leveraging automated networks to
                                    guarantee fast, error-free validation.</p>
                                @if ($state->affiliate_url)
                                    <div class="partner-routing-block">
                                        <div class="partner-row">
                                            <div class="partner-info">
                                                <strong>Formation Partner</strong>
                                                <p>Start your {{ $state->state_name }} business formation with a trusted
                                                    partner.</p>
                                            </div>
                                            <a href="{{ $state->affiliate_url }}" target="_blank"
                                                class="affiliate-link">Start Formation →</a>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li class="step-item" data-step="2">
                                <div class="step-title">Appoint a Dedicated Local Resident Agent</div>
                                <p class="text-gray-600">{{ $state->state_name }} mandates that every business list a
                                    resident agent with a physical in-state street address on public files to accept legal
                                    Service of Process documents.</p>
                            </li>
                            <li class="step-item" data-step="3">
                                <div class="step-title">Secure Your Employer Identification Number (EIN)</div>
                                <p class="text-gray-600">Required to open US business corporate bank checking accounts,
                                    process employee payroll structures, and file local tax declarations.</p>
                            </li>
                            <li class="step-item" data-step="4">
                                <div class="step-title">Draft Your Internal Operating Agreement</div>
                                <p class="text-gray-600">While {{ $state->state_name }} does not require public filing of
                                    your internal operating agreement, maintaining a robust operational rule set protects
                                    corporate veil structures and clarifies multi-member equity layouts internally.</p>
                            </li>
                            <li class="step-item" data-step="5">
                                <div class="step-title">Acquire Sales Tax Licenses & Treasury Registration</div>
                                <p class="text-gray-600">If you intend to distribute physical items or offer taxable
                                    services, you must register for {{ $state->state_name }} Sales Tax and related tax
                                    structures with the appropriate state department.</p>
                            </li>
                        </ul>
                    @endif
                </section>

                <!-- FAQ SECTION -->
                @php $faqs = $state->faqs_data; @endphp
                <section class="faq-section">
                    <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">Frequently Asked
                        Questions ({{ $state->state_name }} Compliance)</h2>
                    @if (!empty($faqs))
                        <div class="faq-wrapper">
                            @foreach ($faqs as $faq)
                                <div class="faq-item">
                                    <h3 class="faq-question">{{ $faq['question'] ?? '' }}</h3>
                                    <p class="faq-answer">{{ $faq['answer'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="faq-wrapper">
                            <div class="faq-item">
                                <h3 class="faq-question">What is the best business structure in {{ $state->state_name }}?
                                </h3>
                                <p class="faq-answer">For most small businesses and startups, an LLC offers the best balance
                                    of liability protection, tax flexibility, and administrative simplicity.</p>
                            </div>
                            <div class="faq-item">
                                <h3 class="faq-question">How much does it cost to start a business in
                                    {{ $state->state_name }}?</h3>
                                <p class="faq-answer">The state filing fee is
                                    <strong>${{ number_format($state->filing_fee, 2) }}</strong>. Additional costs include
                                    registered agent services ($100-$300/year), business licenses, and professional
                                    services.
                                </p>
                            </div>
                            <div class="faq-item">
                                <h3 class="faq-question">How long does it take to form an LLC in {{ $state->state_name }}?
                                </h3>
                                <p class="faq-answer">Standard processing times range from 5 to 20 business days depending
                                    on the state. Many states offer expedited processing for an additional fee.</p>
                            </div>
                            <div class="faq-item">
                                <h3 class="faq-question">Does {{ $state->state_name }} require annual reports?</h3>
                                <p class="faq-answer">
                                    {{ $state->report_required ? 'Yes, ' . $state->state_name . ' requires annual reports to maintain good standing.' : 'No, ' . $state->state_name . ' does not require annual reports for all entity types.' }}
                                    {{ $state->deadline_month && $state->deadline_day ? 'The annual deadline is ' . DateTime::createFromFormat('m', $state->deadline_month)->format('F') . ' ' . $state->deadline_day . '.' : '' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </section>

                <!-- ECOSYSTEM PANEL -->
                <section class="ecosystem-footer-panel">
                    <h3>{{ $state->ecosystem_heading ?? 'Ecosystem Alternative: Buy an Active ' . $state->state_name . ' Asset' }}
                    </h3>
                    <p class="text-gray-700 mb-4">
                        {{ $state->ecosystem_content ?? 'If you prefer to acquire an active business model with existing client revenue rather than starting an entity from scratch, you can browse verified opportunities within the state.' }}
                    </p>
                    <p>Explore live franchises, local business listings, and commercial retail operations directly via <a
                            href="{{ $state->ecosystem_link_url ?? 'https://azibiz.com' }}" target="_blank"
                            style="color: #166534; font-weight: 700; text-decoration: underline;">{{ $state->ecosystem_link_text ?? 'AziBiz.com' }}</a>.
                    </p>
                    <div
                        style="background: #ffffff; padding: 20px; border-radius: 6px; border: 1px dashed #22c55e; margin-top: 15px; text-align: center; color: #475569;">
                        [Dynamic Slider Frame: Featured AziBiz Franchises & Acquisitions inside {{ $state->state_name }}]
                    </div>
                </section>

            </div>
            <!-- End Main Content -->

            <!-- Sidebar -->
            <div class="w-full lg:w-80 flex-shrink-0">

                <!-- All States List -->
                <div class="bg-white border border-gray-200 rounded-xl p-5 sticky top-20">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-500 mb-3">All States</h3>
                    <div class="sidebar-states-list">
                        @if (isset($allStates) && $allStates->count() > 0)
                            @foreach ($allStates as $s)
                                <a href="{{ route('web.state-detail', $s->state_slug) }}"
                                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors
                                {{ $s->id === $state->id ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                                    <span
                                        class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-[10px] font-bold flex-shrink-0
                                    {{ $s->id === $state->id ? 'bg-blue-100 text-blue-700' : '' }}">
                                        {{ substr($s->state_name, 0, 2) }}
                                    </span>
                                    {{ $s->state_name }}
                                </a>
                            @endforeach
                        @else
                            @php $navStates = $navStates ?? collect([]); @endphp
                            @foreach ($navStates as $s)
                                <a href="{{ route('web.state-detail', $s->state_slug) }}"
                                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-colors
                                {{ $s->id === $state->id ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                                    <span
                                        class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-[10px] font-bold flex-shrink-0
                                    {{ $s->id === $state->id ? 'bg-blue-100 text-blue-700' : '' }}">
                                        {{ substr($s->state_name, 0, 2) }}
                                    </span>
                                    {{ $s->state_name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-100 text-center">
                        <a href="{{ route('web.states') }}"
                            class="text-blue-600 text-sm font-semibold hover:underline">View All States Details →</a>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->
        </div>
    </div>

@endsection
