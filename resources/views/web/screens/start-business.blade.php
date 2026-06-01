@extends('web.layouts.app')

@section('title', 'Start a Business - ' . getSetting('site_name'))

@section('meta_description',
    'Everything you need to start, manage, and stay compliant with your business entity.
    Step-by-step guides, filing costs, processing times, and trusted partner integrations.')

@section('meta_keywords', 'start a business, business formation, LLC, corporation, business filing, startup guide')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
        </path>
    </svg>
    Startup Guide
@endsection

@section('page_title', 'Start a Business in Any State')

@section('page_subtitle',
    'From access to major industrial pipelines to straightforward administrative upkeep, we offer
    a robust growth environment for corporate and LLC structures. Review core speed indicators, filing costs, and find out
    how to execute your formation through vetted industry partners.')

@section('content')
    <div class="min-h-screen py-12">
        <div class="container mx-auto px-4">

            <!-- CRITICAL FILE LOGISTICS (FEES & SPEED INDICATORS) -->
            <section>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm"
                        style="border-top: 4px solid #20559a;">
                        <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">State Filing Fee</div>
                        <div class="text-2xl font-extrabold text-gray-900">$50 - $500</div>
                        <div class="text-xs text-gray-500 mt-1">One-time base formation cost varies by state</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm"
                        style="border-top: 4px solid #16a34a;">
                        <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Standard Processing</div>
                        <div class="text-2xl font-extrabold text-gray-900">5 - 20 Days</div>
                        <div class="text-xs text-gray-500 mt-1">State-specific processing queue times</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm"
                        style="border-top: 4px solid #f59e0b;">
                        <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Expedited Processing
                        </div>
                        <div class="text-2xl font-extrabold text-gray-900">24-Hour / Same-Day</div>
                        <div class="text-xs text-gray-500 mt-1">Available tiers with additional fees</div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm"
                        style="border-top: 4px solid #b91c1c;">
                        <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-1">Annual LLC Fee</div>
                        <div class="text-2xl font-extrabold text-gray-900">$0 - $800</div>
                        <div class="text-xs text-gray-500 mt-1">Recurring yearly fee varies by state</div>
                    </div>
                </div>
            </section>

            <!-- STATE SELECTOR -->
            <section class="mb-10">
                <div
                    class="bg-white border-2 border-blue-500 rounded-xl p-8 shadow-lg flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Ready to Register Your Business?</h2>
                        <p class="text-gray-600">Select a state below to get started with your business formation.</p>
                    </div>
                    <div class="flex-shrink-0 w-full lg:w-auto">
                        <select id="state-selector"
                            class="w-full lg:w-72 px-5 py-3.5 rounded-lg border border-gray-300 bg-white text-gray-900 font-medium shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer">
                            <option value="">— Choose a State —</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state_slug }}">{{ $state->state_name }}</option>
                            @endforeach
                        </select>
                        <button id="state-go-btn"
                            class="mt-3 lg:mt-0 lg:ml-3 w-full lg:w-auto inline-block bg-gradient-to-r from-blue-700 to-blue-600 text-white px-8 py-3.5 rounded-lg font-bold hover:from-blue-800 hover:to-blue-700 transition-all shadow-md hover:shadow-lg active:scale-95">
                            Go to State Guide →
                        </button>
                    </div>
                </div>
            </section>

            <!-- STRATEGIC BENEFITS -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">Strategic Benefits
                    of Business Formation</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mt-0 mb-3">Personal Asset Protection</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Forming an LLC or Corporation creates a legal
                            separation between your personal and business assets. Your house, car, and savings remain
                            protected from business liabilities and creditors.</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mt-0 mb-3">Tax Flexibility & Savings</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Business entities unlock tax deductions unavailable
                            to sole proprietors. From pass-through taxation for LLCs to corporate tax rates for C Corps,
                            choose the structure that minimizes your tax burden.</p>
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mt-0 mb-3">Credibility & Growth Capital</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Registered entities project professionalism to
                            clients, partners, and investors. You gain access to business banking, commercial credit, and
                            venture capital that unregistered businesses cannot access.</p>
                    </div>
                </div>
            </section>

            <!-- HIGH-GROWTH INDUSTRIES TABLE -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">High-Growth
                    Industries by State</h2>
                <p class="text-gray-600 mb-6">Forming an industry-specific entity requires mapping state codes and local
                    demand patterns. Explore our deep guides on top operational vertical landscapes:</p>

                <div class="overflow-x-auto mb-8 border border-gray-200 rounded-xl">
                    <table class="w-full border-collapse text-left text-sm">
                        <thead>
                            <tr>
                                <th class="bg-gray-50 text-gray-900 font-semibold px-4 py-3.5 border-b-2 border-gray-200">
                                    Target Industry Category</th>
                                <th class="bg-gray-50 text-gray-900 font-semibold px-4 py-3.5 border-b-2 border-gray-200">
                                    Avg. Startup Cost</th>
                                <th class="bg-gray-50 text-gray-900 font-semibold px-4 py-3.5 border-b-2 border-gray-200">
                                    Regulatory Overhead</th>
                                <th class="bg-gray-50 text-gray-900 font-semibold px-4 py-3.5 border-b-2 border-gray-200">
                                    Market Growth (YoY)</th>
                                <th class="bg-gray-50 text-gray-900 font-semibold px-4 py-3.5 border-b-2 border-gray-200">
                                    Deep Dive Guides</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3.5 border-b border-gray-200 font-semibold text-gray-900">Health Care &
                                    Senior Support Services</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">$85,000</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">High / Complex</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">+4.2%</td>
                                <td class="px-4 py-3.5 border-b border-gray-200">
                                    <a href="{{ route('web.industries') }}"
                                        class="text-blue-600 font-semibold hover:underline">View Healthcare Requirements
                                        →</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3.5 border-b border-gray-200 font-semibold text-gray-900">Construction &
                                    Commercial Development</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">$120,000</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">Medium</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">+5.1%</td>
                                <td class="px-4 py-3.5 border-b border-gray-200">
                                    <a href="{{ route('web.industries') }}"
                                        class="text-blue-600 font-semibold hover:underline">View Construction Laws →</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3.5 border-b border-gray-200 font-semibold text-gray-900">Professional &
                                    Technical E-Commerce Services</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">$15,000</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">Low</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">+3.8%</td>
                                <td class="px-4 py-3.5 border-b border-gray-200">
                                    <a href="{{ route('web.industries') }}"
                                        class="text-blue-600 font-semibold hover:underline">View Digital Services Code →</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3.5 border-b border-gray-200 font-semibold text-gray-900">Logistics,
                                    Freight & Local Shipping Hubs</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">$65,000</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">Medium</td>
                                <td class="px-4 py-3.5 border-b border-gray-200 text-gray-600">+4.7%</td>
                                <td class="px-4 py-3.5 border-b border-gray-200">
                                    <a href="{{ route('web.industries') }}"
                                        class="text-blue-600 font-semibold hover:underline">View Freight Regulations →</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- EXECUTION BLUEPRINT: STEP-BY-STEP -->
            <section id="execution-blueprint">
                <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">The Execution
                    Blueprint: Step-by-Step Pathway</h2>
                <p class="text-gray-600 mb-8">Rather than managing complex state paperwork manually, you can route your
                    setup steps through verified digital filing providers:</p>

                <div class="space-y-8 mb-10">
                    <!-- Step 1 -->
                    <div class="relative pl-12">
                        <div
                            class="absolute left-0 top-1 w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            1</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Choose Your Business Structure</h3>
                        <p class="text-gray-600 mb-4">Decide between LLC, C Corporation, S Corporation, or Sole
                            Proprietorship. Each structure offers different tax treatments, liability protections, and
                            administrative requirements.

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                            @forelse ($entityTypes as $entityType)
                                <div
                                    class="flex items-center justify-between bg-white border border-gray-200 rounded-lg p-4 mb-3 last:mb-0">
                                    <div>
                                        <strong class="text-gray-900">{{ $entityType->name }}</strong>
                                        <p class="text-xs text-gray-600 mt-1">
                                            @if ($entityType->slug === 'llc')
                                                Best for small business owners seeking liability protection with
                                                pass-through taxation.
                                            @elseif ($entityType->slug === 'c-corporation')
                                                Ideal for businesses seeking venture capital with corporate tax structure.
                                            @elseif ($entityType->slug === 's-corporation')
                                                Combines liability protection with pass-through taxation and self-employment
                                                savings.
                                            @elseif ($entityType->slug === 'sole-proprietorship')
                                                Simplest structure for single-owner businesses with no liability separation.
                                            @else
                                                {{ $entityType->description ?? 'Learn more about this entity type.' }}
                                            @endif
                                        </p>
                                    </div>
                                    <a href="{{ route('web.entity-type-detail', $entityType->slug) }}"
                                        class="flex-shrink-0 inline-block text-green-600 font-bold text-sm border border-green-600 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition-all">
                                        Learn More →
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4 text-gray-500">Entity types not available.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative pl-12">
                        <div
                            class="absolute left-0 top-1 w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            2</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Select Your Formation State</h3>
                        <p class="text-gray-600 mb-4">Choose the state where you want to form your business. Each state has
                            different filing fees, processing times, and annual requirements.</p>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                @forelse ($states as $state)
                                    <a href="{{ route('web.state-detail', $state->state_slug) }}"
                                        class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-4 py-3 hover:border-blue-300 hover:shadow-md transition-all text-gray-700 hover:text-blue-800 font-medium text-sm">
                                        <span
                                            class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[10px] font-bold flex-shrink-0">{{ substr($state->state_name, 0, 2) }}</span>
                                        {{ $state->state_name }}
                                    </a>
                                @empty
                                    <div class="col-span-full text-center py-4 text-gray-500">States not available.</div>
                                @endforelse
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('web.states') }}"
                                    class="inline-block text-blue-700 font-semibold text-sm hover:underline">View All
                                    States Details →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative pl-12">
                        <div
                            class="absolute left-0 top-1 w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            3</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">File Formation Documents</h3>
                        <p class="text-gray-600 mb-4">Submit formal constitutional documents to the state's filing agency.
                            We recommend leveraging automated networks to guarantee fast, error-free validation.</p>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                            <div
                                class="flex items-center justify-between bg-white border border-gray-200 rounded-lg p-4 mb-3">
                                <div>
                                    <strong class="text-gray-900">Top Pick: Bizee (Formerly Incfile)</strong>
                                    <p class="text-xs text-gray-600 mt-1">Excellent for baseline LLC setups. Offers $0
                                        silver packages (plus state fees).</p>
                                </div>
                                <a href="#" target="_blank"
                                    class="flex-shrink-0 inline-block text-green-600 font-bold text-sm border border-green-600 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition-all">Form
                                    via Bizee →</a>
                            </div>
                            <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg p-4">
                                <div>
                                    <strong class="text-gray-900">Premium Pick: ZenBusiness</strong>
                                    <p class="text-xs text-gray-600 mt-1">Includes customizable operating agreement
                                        templates and automated processing updates.</p>
                                </div>
                                <a href="#" target="_blank"
                                    class="flex-shrink-0 inline-block text-green-600 font-bold text-sm border border-green-600 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition-all">Form
                                    via ZenBusiness →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative pl-12">
                        <div
                            class="absolute left-0 top-1 w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            4</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Appoint a Registered Agent</h3>
                        <p class="text-gray-600 mb-4">Most states mandate that every business list a resident agent with a
                            physical in-state street address on public files to accept legal Service of Process documents.
                        </p>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                            <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg p-4">
                                <div>
                                    <strong class="text-gray-900">Northwest Registered Agent</strong>
                                    <p class="text-xs text-gray-600 mt-1">Premium corporate agent network. Protects privacy
                                        by keeping personal home addresses off state records.</p>
                                </div>
                                <a href="#" target="_blank"
                                    class="flex-shrink-0 inline-block text-green-600 font-bold text-sm border border-green-600 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition-all">Appoint
                                    Agent →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative pl-12">
                        <div
                            class="absolute left-0 top-1 w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            5</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Secure Your EIN & Register for Taxes</h3>
                        <p class="text-gray-600">Required to open US business corporate bank checking accounts, process
                            employee payroll structures, and file local tax declarations. Additionally, register for state
                            sales tax and related tax structures if applicable.</p>
                    </div>

                    <!-- Step 6 -->
                    <div class="relative pl-12">
                        <div
                            class="absolute left-0 top-1 w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            6</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Meet Annual Compliance Requirements</h3>
                        <p class="text-gray-600">Most states require annual reports, franchise tax payments, or statement
                            filings to keep your business in good standing. Deadlines and fees vary by state and entity
                            type.</p>
                    </div>
                </div>
            </section>

            <!-- FAQ SECTION -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-3 border-b-2 border-gray-200">Frequently Asked
                    Questions</h2>
                <div class="space-y-4 mb-10">
                    <div class="border border-gray-200 rounded-xl p-6 bg-white">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">What is the best business structure for a startup?
                        </h3>
                        <p class="text-gray-600 text-sm">For most small businesses and startups, an LLC (Limited Liability
                            Company) offers the best balance of liability protection, tax flexibility, and administrative
                            simplicity. However, if you plan to seek venture capital, a C Corporation may be more
                            appropriate. S Corporations are ideal for businesses looking to save on self-employment taxes
                            while maintaining pass-through taxation.</p>
                    </div>
                    <div class="border border-gray-200 rounded-xl p-6 bg-white">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">How much does it cost to start a business?</h3>
                        <p class="text-gray-600 text-sm">The cost varies significantly by state. State filing fees range
                            from $50 to $500 for LLCs and Corporations. Additional costs include registered agent services
                            ($100-$300/year), business licenses, and professional services. Use our state guides to get
                            exact figures for your chosen state.</p>
                    </div>
                    <div class="border border-gray-200 rounded-xl p-6 bg-white">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">How long does it take to form an LLC?</h3>
                        <p class="text-gray-600 text-sm">Standard processing times range from 5 to 20 business days
                            depending on the state. Many states offer expedited processing for an additional fee, with
                            options ranging from 24-hour to same-day processing. Some states like New York and California
                            can take 2-4 weeks for standard processing.</p>
                    </div>
                    <div class="border border-gray-200 rounded-xl p-6 bg-white">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Do I need a registered agent?</h3>
                        <p class="text-gray-600 text-sm">Yes, most states require LLCs and Corporations to maintain a
                            registered agent with a physical address in the state of formation. The registered agent accepts
                            legal documents and official state correspondence on behalf of your business. Many formation
                            services include registered agent service in their packages.</p>
                    </div>
                    <div class="border border-gray-200 rounded-xl p-6 bg-white">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">What are the ongoing compliance requirements?</h3>
                        <p class="text-gray-600 text-sm">Annual requirements vary by state and entity type. Common
                            obligations include filing annual reports, paying franchise taxes, maintaining a registered
                            agent, and filing business tax returns. Some states like California have additional requirements
                            like a minimum franchise tax of $800 per year.</p>
                    </div>
                </div>
            </section>

            <!-- ECOSYSTEM PANEL -->
            <section class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-8 mb-8">
                <h3 class="text-xl font-bold text-green-800 mt-0 mb-3">Ecosystem Alternative: Buy an Active Business</h3>
                <p class="text-gray-700 mb-4">If you prefer to acquire an active business model with existing client
                    revenue rather than starting an entity from scratch, you can browse verified opportunities across all
                    states.</p>
                <p class="text-gray-700">Explore live franchises, local business listings, and commercial retail operations
                    directly via <a href="https://azibiz.com" target="_blank"
                        class="text-green-700 font-bold underline hover:text-green-800">AziBiz.com</a>.</p>

                <div class="bg-white rounded-lg p-5 border border-dashed border-green-400 mt-4 text-center text-gray-600">
                    [Dynamic Slider Frame: Featured AziBiz Franchises & Acquisitions]
                </div>
            </section>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stateSelector = document.getElementById('state-selector');
            const goBtn = document.getElementById('state-go-btn');

            function goToState() {
                const slug = stateSelector.value;
                if (slug) {
                    window.location.href = '{{ url('states') }}/' + slug;
                } else {
                    alert('Please select a state first.');
                }
            }

            goBtn.addEventListener('click', goToState);
            stateSelector.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    goToState();
                }
            });
        });
    </script>
@endpush
