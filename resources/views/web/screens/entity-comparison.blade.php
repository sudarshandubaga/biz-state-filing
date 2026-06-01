@extends('web.layouts.app')

@section('title', $seo['title'] ?? $comparisonTitle . ' - Comparison')
@section('meta_description', $seo['description'] ?? '')
@section('meta_keywords', $seo['keywords'] ?? '')

@php
    $page_title = $comparisonTitle;
    $page_subtitle =
        'A detailed comparison between ' .
        $entityType1->name .
        ' and ' .
        $entityType2->name .
        ' to help you choose the right business structure.';
    $page_badge = '<i class="fa-solid fa-scale-balanced mr-1.5"></i> Entity Comparison';
@endphp

@section('content')
    <!-- ============================================
        HERO SECTION (Compact)
        ============================================ -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 py-12">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE4YzEuNjU3IDAgMy0xLjM0MyAzLTNzLTEuMzQzLTMtMy0zLTMgMS4zNDMtMyAzIDEuMzQzIDMgMyAzem0wIDM2YzEuNjU3IDAgMy0xLjM0MyAzLTNzLTEuMzQzLTMtMy0zLTMgMS4zNDMtMyAzIDEuMzQzIDMgMyAzek0xOCAzNmMxLjY1NyAwIDMtMS4zNDMgMy0zcy0xLjM0My0zLTMtMy0zIDEuMzQzLTMgMyAxLjM0MyAzIDMgM3oiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30">
        </div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-sm font-medium px-4 py-2 rounded-full mb-5">
                    <i class="fa-solid fa-scale-balanced"></i>
                    Entity Comparison
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-3">
                    {{ $comparisonTitle }}
                </h1>
                <p class="text-lg text-white/80 max-w-2xl mx-auto">
                    See how <strong class="text-white">{{ $entityType1->name }}</strong> and
                    <strong class="text-white">{{ $entityType2->name }}</strong> stack up across key factors.
                </p>
            </div>
        </div>
    </section>

    <!-- ============================================
        QUICK STATS / SNAPSHOT
        ============================================ -->
    <section class="py-10 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <!-- Entity 1 -->
                <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="text-2xl font-bold text-blue-700">{{ $entityType1->name }}</div>
                    @if ($entityType1->label)
                        <div class="text-xs text-blue-600 mt-1">{{ $entityType1->label }}</div>
                    @endif
                    @if ($entityType1->formation_cost_range)
                        <div class="mt-2 text-sm">
                            <span class="text-gray-500 text-xs">Cost</span>
                            <div class="font-semibold text-gray-800">{{ $entityType1->formation_cost_range }}</div>
                        </div>
                    @endif
                </div>

                <div class="text-center p-4 bg-green-50 rounded-xl border border-green-100">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Best For</div>
                    <div class="text-sm font-semibold text-gray-800 mt-1">
                        {{ $entityType1->best_for_tagline ?? 'Small business owners' }}</div>
                </div>

                <div class="text-center p-4 bg-purple-50 rounded-xl border border-purple-100">
                    <div class="text-2xl font-bold text-purple-700">{{ $entityType2->name }}</div>
                    @if ($entityType2->label)
                        <div class="text-xs text-purple-600 mt-1">{{ $entityType2->label }}</div>
                    @endif
                    @if ($entityType2->formation_cost_range)
                        <div class="mt-2 text-sm">
                            <span class="text-gray-500 text-xs">Cost</span>
                            <div class="font-semibold text-gray-800">{{ $entityType2->formation_cost_range }}</div>
                        </div>
                    @endif
                </div>

                <div class="text-center p-4 bg-orange-50 rounded-xl border border-orange-100">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Best For</div>
                    <div class="text-sm font-semibold text-gray-800 mt-1">
                        {{ $entityType2->best_for_tagline ?? 'Growing businesses' }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
        COMPARISON TABLE
        ============================================ -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Side-by-Side Comparison</h2>

                @if ($comparisons->count() > 0)
                    @php
                        $grouped = $comparisons->groupBy('category');
                    @endphp

                    @foreach ($grouped as $category => $items)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                                    {{ $category === 'overview' ? 'Overview' : ($category === 'taxation' ? 'Taxation' : ($category === 'liability' ? 'Liability Protection' : ($category === 'formation' ? 'Formation Requirements' : ($category === 'compliance' ? 'Compliance & Ongoing Requirements' : ($category === 'ownership' ? 'Ownership Structure' : ($category === 'management' ? 'Management Structure' : ($category === 'cost' ? 'Cost Comparison' : ($category === 'fundraising' ? 'Fundraising & Investment' : ucfirst($category))))))))) }}
                                </h3>
                            </div>
                            <div class="divide-y divide-gray-100">
                                @foreach ($items as $item)
                                    <div class="px-6 py-5">
                                        @if ($item->title)
                                            <h4 class="font-medium text-gray-900 mb-2">{{ $item->title }}</h4>
                                        @endif
                                        @if ($item->content)
                                            <div class="text-sm text-gray-700 leading-relaxed">
                                                {{ $item->content }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Dynamic comparison from entity type data -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">
                                            Feature</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-blue-700 uppercase tracking-wider w-1/3">
                                            {{ $entityType1->name }}</th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-medium text-purple-700 uppercase tracking-wider w-1/3">
                                            {{ $entityType2->name }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Liability Protection</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType1->liability_protection ?? 'Limited liability protection' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType2->liability_protection ?? 'Limited liability protection' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Taxation Type</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType1->taxation_type ?? 'Pass-through taxation' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType2->taxation_type ?? 'Pass-through taxation' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Ownership Structure</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType1->ownership_structure ?? 'Flexible' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType2->ownership_structure ?? 'Flexible' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Formation Cost</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType1->formation_cost_range ?? 'Varies by state' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType2->formation_cost_range ?? 'Varies by state' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Compliance Level</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType1->compliance_level ?? 'Moderate' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType2->compliance_level ?? 'High' }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Complexity</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType1->complexity_level ?? 'Low' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $entityType2->complexity_level ?? 'Moderate' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- ============================================
        CALL TO ACTION
        ============================================ -->
    <section class="py-14 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Ready to Start Your Business?</h2>
            <p class="text-lg text-white/80 mb-6 max-w-2xl mx-auto">
                Let us help you form your {{ $entityType1->name }} or {{ $entityType2->name }} in just a few simple steps.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('formation.start') }}"
                    class="inline-flex items-center justify-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-8 py-3.5 rounded-lg text-lg transition-all shadow-lg">
                    <i class="fa-solid fa-rocket"></i>
                    Start My {{ $entityType1->name }}
                </a>
                @if ($entityType2->status)
                    <a href="{{ route('formation.start') }}"
                        class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-8 py-3.5 rounded-lg text-lg transition-all border border-white/30">
                        <i class="fa-solid fa-building"></i>
                        Form a {{ $entityType2->name }}
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
