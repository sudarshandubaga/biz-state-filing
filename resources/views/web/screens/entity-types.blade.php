@extends('web.layouts.app')

@section('title', 'Business Entity Types – LLC, C Corp, S Corp, Nonprofit & More – BizStateFiling')

@section('meta_description',
    'Compare LLC, Corporation, Nonprofit, DBA and other business entity types. Learn formation
    requirements, costs, and compliance for each.')

@section('meta_keywords',
    'business entity types, LLC, corporation, nonprofit, DBA, sole proprietorship, partnership,
    business structure')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
        </path>
    </svg>
    Entity Types
@endsection

@section('page_title', 'Business Entity Types')

@section('page_subtitle',
    'Compare LLC, Corporation, Nonprofit, DBA and other business entity types. Learn which
    structure is right for your business needs.')

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

        .entity-card-link {
            display: block;
            height: 100%;
            text-decoration: none;
        }

        .entity-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 32px;
            transition: all .3s ease;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .04);
        }

        .entity-card:hover {
            transform: translateY(-6px);
            border-color: #bfdbfe;
            box-shadow: 0 20px 50px rgba(37, 99, 235, .12);
        }

        .entity-card-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            font-size: 26px;
            color: var(--primary);
            margin-bottom: 20px;
            transition: all .3s ease;
        }

        .entity-card:hover .entity-card-icon {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
        }

        .entity-card h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 12px;
            transition: color .3s ease;
        }

        .entity-card:hover h3 {
            color: var(--primary);
        }

        .entity-card p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .entity-card .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding-top: 16px;
            border-top: 1px solid #eef2ff;
        }

        .entity-card .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            background: #f8fafc;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .entity-card .meta-badge i {
            font-size: 10px;
            color: var(--primary);
        }

        .comparison-section {
            background: linear-gradient(135deg, #f0f4fa 0%, #ffffff 100%);
            border: 1px solid var(--border);
            border-radius: 32px;
            padding: 48px;
        }

        .comparison-table-wrap {
            overflow-x: auto;
            border-radius: 20px;
            border: 1px solid var(--border);
            background: #fff;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .04);
        }

        .comparison-table-wrap table {
            width: 100%;
            border-collapse: collapse;
        }

        .comparison-table-wrap th {
            background: #eff6ff;
            padding: 16px 18px;
            font-size: 13px;
            font-weight: 800;
            color: var(--dark);
            text-align: left;
            border-bottom: 2px solid #dbeafe;
            white-space: nowrap;
        }

        .comparison-table-wrap td {
            padding: 14px 18px;
            font-size: 14px;
            color: var(--text);
            border-bottom: 1px solid #eef2ff;
        }

        .comparison-table-wrap tr:last-child td {
            border-bottom: none;
        }

        .comparison-table-wrap tr:hover td {
            background: #f8fafc;
        }

        .guide-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 28px;
            height: 100%;
            transition: all .3s ease;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .04);
        }

        .guide-card:hover {
            transform: translateY(-4px);
            border-color: #bfdbfe;
            box-shadow: 0 18px 40px rgba(37, 99, 235, .10);
        }

        .guide-card h5 {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .guide-card p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 0;
        }

        .faq-item {
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .faq-item button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 22px;
            font-weight: 700;
            font-size: 16px;
            color: var(--dark);
            text-align: left;
            background: #fff;
            border: none;
            cursor: pointer;
            transition: background .2s ease;
        }

        .faq-item button:hover {
            background: #eff6ff;
        }

        .faq-item .faq-answer {
            padding: 0 22px 20px;
            font-size: 15px;
            line-height: 1.9;
            color: var(--muted);
        }

        .cta-gradient {
            background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
            border-radius: 32px;
            padding: 56px 48px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .cta-gradient:before {
            content: '';
            position: absolute;
            right: -80px;
            bottom: -80px;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, .08);
            border-radius: 50%;
        }

        .cta-gradient h2 {
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .cta-gradient p {
            font-size: 17px;
            line-height: 1.9;
            color: rgba(255, 255, 255, .88);
            max-width: 700px;
        }

        .cta-light-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            background: #fff;
            color: var(--primary);
            font-weight: 700;
            border-radius: 16px;
            text-decoration: none;
            transition: opacity .2s ease;
        }

        .cta-outline-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            border: 1px solid rgba(255, 255, 255, .25);
            color: #fff;
            font-weight: 700;
            border-radius: 16px;
            text-decoration: none;
            transition: opacity .2s ease;
        }

        .cta-light-btn:hover,
        .cta-outline-btn:hover {
            opacity: .9;
            color: inherit;
        }

        .section-title-lg {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -.5px;
        }

        @media (max-width: 768px) {
            .section-title-lg {
                font-size: 28px;
            }
        }
    </style>

    <div class="container mx-auto px-4 py-10">

        <!-- ENTITY TYPES GRID SECTION -->
        <section>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                <div>
                    <h2 class="section-title-lg">All Entity Types</h2>
                    <p class="text-gray-500 mt-2">Choose the right business structure for your needs</p>
                </div>
                <span class="text-sm text-gray-400 mt-2 sm:mt-0">{{ $entityTypes->total() }} types available</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($entityTypes as $entityType)
                    <a href="{{ route('web.entity-type-detail', $entityType->slug) }}" class="entity-card-link">
                        <div class="entity-card">
                            <div class="entity-card-icon">
                                @if ($entityType->icon)
                                    <i class="fa-solid {{ $entityType->icon }}"></i>
                                @else
                                    <i class="fa-solid fa-building"></i>
                                @endif
                            </div>
                            <h3>{{ $entityType->label ?? $entityType->name }}</h3>
                            <p>{{ $entityType->short_description ?? ($entityType->description ? Str::limit(strip_tags($entityType->description), 120) : 'Learn about ' . $entityType->name . ' formation, requirements, and compliance.') }}
                            </p>
                            <div class="meta-row">
                                @if ($entityType->liability_protection)
                                    <span class="meta-badge"><i class="fa-solid fa-shield"></i>
                                        {{ $entityType->liability_protection }}</span>
                                @endif
                                @if ($entityType->formation_cost_range)
                                    <span class="meta-badge"><i class="fa-solid fa-dollar-sign"></i>
                                        {{ $entityType->formation_cost_range }}</span>
                                @endif
                                @if ($entityType->compliance_level)
                                    <span class="meta-badge"><i class="fa-solid fa-clipboard-check"></i>
                                        {{ $entityType->compliance_level }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">No entity types available yet.</div>
                @endforelse
            </div>

            @if ($entityTypes->hasPages())
                <div class="mt-8">{{ $entityTypes->links() }}</div>
            @endif
        </section>

        <!-- QUICK COMPARISON SECTION -->
        @php $allEntityTypes = isset($allEntityTypes) ? $allEntityTypes : $entityTypes; @endphp
        @if ($allEntityTypes && $allEntityTypes->count() > 0)
            <section class="mt-20">
                <div class="comparison-section">
                    <h2 class="section-title-lg mb-2">Side-by-Side Comparison</h2>
                    <p class="text-gray-500 mb-8">Quick overview of key differences between entity structures</p>

                    <div class="comparison-table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Structure</th>
                                    <th>Liability</th>
                                    <th>Taxation</th>
                                    <th>Complexity</th>
                                    <th>Ownership</th>
                                    <th>Best For</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allEntityTypes as $et)
                                    <tr>
                                        <td><strong>{{ $et->label ?? $et->name }}</strong></td>
                                        <td>{{ $et->liability_protection ?? '—' }}</td>
                                        <td>{{ $et->taxation_type ?? '—' }}</td>
                                        <td>{{ $et->complexity_level ?? '—' }}</td>
                                        <td>{{ $et->ownership_structure ?? '—' }}</td>
                                        <td>{{ $et->best_for_tagline ?? ($et->short_description ? Str::limit($et->short_description, 50) : '—') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        @endif

        <!-- HOW TO CHOOSE GUIDE SECTION -->
        <section class="mt-20">
            <h2 class="section-title-lg mb-2">How to Choose the Right Entity Type</h2>
            <p class="text-gray-500 mb-8">Consider these factors when deciding which business structure fits your needs</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="guide-card">
                    <div class="entity-card-icon"
                        style="background: linear-gradient(135deg,#fef3c7,#fde68a); color: #d97706;">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h5>Liability Protection</h5>
                    <p>Determine how much personal asset protection you need. LLCs and Corporations offer strong liability
                        shields, while Sole Props offer none.</p>
                </div>
                <div class="guide-card">
                    <div class="entity-card-icon"
                        style="background: linear-gradient(135deg,#dbeafe,#bfdbfe); color: #2563eb;">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h5>Tax Implications</h5>
                    <p>Pass-through entities like LLCs and S Corps avoid double taxation, while C Corps pay corporate taxes.
                        Consider your profit expectations.</p>
                </div>
                <div class="guide-card">
                    <div class="entity-card-icon"
                        style="background: linear-gradient(135deg,#d1fae5,#a7f3d0); color: #059669;">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <h5>Growth & Funding</h5>
                    <p>If you plan to raise venture capital or go public, a C Corporation is typically required. LLCs work
                        best for bootstrapped or lifestyle businesses.</p>
                </div>
                <div class="guide-card">
                    <div class="entity-card-icon"
                        style="background: linear-gradient(135deg,#fce7f3,#fbcfe8); color: #db2777;">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <h5>Administrative Burden</h5>
                    <p>Consider ongoing compliance costs. LLCs have fewer requirements than Corporations, but both need
                        annual reports, agent services, and record-keeping.</p>
                </div>
            </div>
        </section>

        <!-- FAQ SECTION -->
        <section class="mt-20">
            <h2 class="section-title-lg mb-2">Frequently Asked Questions</h2>
            <p class="text-gray-500 mb-8">Common questions about business entity types</p>

            <div class="max-w-3xl">
                <div class="faq-item">
                    <button onclick="toggleFaq(this)">
                        <span>What is the best entity type for a small business?</span>
                        <svg class="w-4 h-4 text-blue-600 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden">For most small businesses, an LLC (Limited Liability Company) offers the
                        best combination of liability protection, tax flexibility, and administrative simplicity. Sole
                        proprietorships are simpler but offer no liability protection.</div>
                </div>
                <div class="faq-item">
                    <button onclick="toggleFaq(this)">
                        <span>What's the difference between an S Corp and C Corp?</span>
                        <svg class="w-4 h-4 text-blue-600 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden">S Corporations have pass-through taxation (no corporate tax) but have
                        strict ownership limits (max 100 shareholders, all US citizens). C Corporations face double taxation
                        but can have unlimited shareholders and are better for venture capital.</div>
                </div>
                <div class="faq-item">
                    <button onclick="toggleFaq(this)">
                        <span>Can I change my entity type later?</span>
                        <svg class="w-4 h-4 text-blue-600 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden">Yes, you can convert between entity types, though the process varies.
                        Converting from LLC to Corporation is common as businesses grow. Some conversions have tax
                        implications, so consult a professional.</div>
                </div>
                <div class="faq-item">
                    <button onclick="toggleFaq(this)">
                        <span>How much does it cost to form each entity type?</span>
                        <svg class="w-4 h-4 text-blue-600 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="faq-answer hidden">State filing fees range from $50 to $500 for LLCs and Corporations. Sole
                        proprietorships typically have minimal or no filing fees. Additional costs include registered agent
                        services ($100-$300/yr) and annual report fees.</div>
                </div>
            </div>
        </section>

        <!-- CTA SECTION -->
        <section class="mt-20">
            <div class="cta-gradient">
                <h2>Ready to Start Your Business?</h2>
                <p>Form your LLC, Corporation, or other entity type with our trusted formation partners. Get started in
                    minutes with expert guidance.</p>
                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="{{ route('formation.start') }}" class="cta-light-btn"><i
                            class="fa-solid fa-arrow-right-circle"></i> Start Your Formation</a>
                    <a href="{{ route('web.start-business') }}" class="cta-outline-btn"><i
                            class="fa-solid fa-store"></i> View Startup Guide</a>
                </div>
            </div>
        </section>

    </div>

@endsection

@push('scripts')
    <script>
        function toggleFaq(btn) {
            const answer = btn.nextElementSibling;
            const icon = btn.querySelector('svg');
            answer.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    </script>
@endpush
