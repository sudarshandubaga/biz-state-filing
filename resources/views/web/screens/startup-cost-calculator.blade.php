@extends('web.layouts.app')

@section('title', 'Startup Cost Calculator | StateFilingDeadlines')
@section('meta_description', 'Estimate your initial business investment including state fees, registered agent,
    equipment, and legal compliance costs with our free startup cost calculator.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#0f172a] to-[#1e293b] text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Startup Cost Calculator</h1>
                <p class="text-lg text-gray-300">Estimate your initial business investment including state fees, equipment,
                    and legal compliance costs.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Calculator -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                    <h4 class="text-lg font-bold mb-6">Expense Breakdown</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Filing Fees -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">State Filing Fee (Avg
                                $50-$500)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-gray-600 font-semibold text-sm">$</span>
                                <input type="number"
                                    class="calc-input flex-1 block w-full px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none"
                                    id="filingFee" value="150" oninput="calculateTotal()">
                            </div>
                        </div>

                        <!-- Registered Agent -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">Registered Agent
                                (Annual)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-gray-600 font-semibold text-sm">$</span>
                                <input type="number"
                                    class="calc-input flex-1 block w-full px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none"
                                    id="agentFee" value="99" oninput="calculateTotal()">
                            </div>
                        </div>

                        <!-- Equipment -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">Equipment & Supplies</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-gray-600 font-semibold text-sm">$</span>
                                <input type="number"
                                    class="calc-input flex-1 block w-full px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none"
                                    id="equipment" value="1000" oninput="calculateTotal()">
                            </div>
                        </div>

                        <!-- Marketing -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">Website & Marketing</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-gray-600 font-semibold text-sm">$</span>
                                <input type="number"
                                    class="calc-input flex-1 block w-full px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none"
                                    id="marketing" value="500" oninput="calculateTotal()">
                            </div>
                        </div>

                        <!-- Other -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-900 mb-1.5">Other (Insurance, Licenses,
                                Permits)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-gray-600 font-semibold text-sm">$</span>
                                <input type="number"
                                    class="calc-input flex-1 block w-full px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none"
                                    id="other" value="250" oninput="calculateTotal()">
                            </div>
                        </div>
                    </div>

                    <!-- Total Box -->
                    <div class="mt-8 bg-blue-50 border-2 border-blue-700 rounded-xl p-6 text-center">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Estimated Launch Cost</span>
                        <div class="text-4xl font-extrabold text-blue-700 mt-1" id="grandTotal">$1,999</div>
                        <p class="text-xs text-gray-500 mt-2">Total based on selected initial investments.</p>
                    </div>
                </div>

                <!-- Tips -->
                <div class="mt-5 bg-white border border-gray-200 rounded-2xl p-6">
                    <h5 class="font-bold text-lg mb-3">How to lower these costs?</h5>
                    <p class="text-sm text-gray-600">Many entrepreneurs overspend on initial equipment. Focus on legal
                        compliance first (EIN, Registered Agent, and State Filing) to ensure your business exists legally
                        before committing to high-cost retail leases or equipment.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-gray-200 p-7 shadow-sm sticky top-28">
                    <h5 class="text-lg font-bold mb-3">Launch Without the Stress</h5>
                    <p class="text-sm text-gray-600 mb-5">We've helped thousands of owners simplify the "other" costs
                        through automated filings.</p>

                    <div class="flex items-start gap-3 mb-3">
                        <i class="fa-solid fa-circle-check text-green-500 mt-0.5"></i>
                        <p class="text-sm"><strong>Verified Fees:</strong> We pull direct state fee data for your entity
                            type.</p>
                    </div>
                    <div class="flex items-start gap-3 mb-6">
                        <i class="fa-solid fa-circle-check text-green-500 mt-0.5"></i>
                        <p class="text-sm"><strong>Bundle Savings:</strong> Get your EIN, Agent, and Filing in one 9-step
                            flow.</p>
                    </div>

                    <a href="{{ route('formation.start') }}"
                        class="block w-full bg-blue-700 hover:bg-blue-800 text-white text-center py-3 rounded-lg font-bold transition-all shadow-md mb-3">
                        Start 9-Step Filing
                    </a>
                    <a href="{{ route('web.forms-library') }}"
                        class="block w-full border-2 border-gray-300 hover:border-gray-400 text-gray-700 text-center py-2.5 rounded-lg font-medium text-sm transition-all">
                        View Forms Library
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function calculateTotal() {
                const inputs = document.querySelectorAll('.calc-input');
                let total = 0;

                inputs.forEach(input => {
                    total += Number(input.value) || 0;
                });

                document.getElementById('grandTotal').innerText = '$' + total.toLocaleString();
            }
        </script>
    @endpush
@endsection
