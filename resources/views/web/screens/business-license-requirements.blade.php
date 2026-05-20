@extends('web.layouts.app')

@section('title', 'Business License Requirements | StateFilingDeadlines')
@section('meta_description',
    'Identify the local, state, and federal permits required to operate your business legally.
    Common required permits for business compliance.')

@section('page_title', 'Business License Requirements')

@section('page_subtitle', 'Identify the local, state, and federal permits required to operate your business legally.')

@section('content')

    <!-- Main Content -->
    <div class="container mx-auto px-4 pb-12" style="margin-top: -60px;">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Column -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
                    <h4 class="text-lg font-bold mb-6">Common Required Permits</h4>

                    <!-- Item 1 -->
                    <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-100">
                        <div
                            class="w-12 h-12 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <div>
                            <h6 class="font-bold mb-1">General Business License</h6>
                            <p class="text-sm text-gray-600">A basic permit issued by your city or county allowing you to
                                operate within their jurisdiction. Most physical storefronts require this.</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-100">
                        <div
                            class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <div>
                            <h6 class="font-bold mb-1">Sales Tax Permit (Seller's Permit)</h6>
                            <p class="text-sm text-gray-600">Required for businesses selling tangible goods. This allows you
                                to collect sales tax from customers and issue resale certificates to suppliers.</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-100">
                        <div
                            class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h6 class="font-bold mb-1">Professional / Industry Licenses</h6>
                            <p class="text-sm text-gray-600">Specialized permits for industries like Senior Care,
                                Construction, Legal, or Food Service. Often requires proof of certification.</p>
                        </div>
                    </div>

                    <!-- Pro Tip -->
                    <div class="mt-6 p-5 bg-blue-50 rounded-xl border-l-4 border-blue-700">
                        <h6 class="font-bold flex items-center gap-2 mb-1">
                            <i class="fa-solid fa-circle-info text-blue-700"></i> Pro Tip: Zoning Permits
                        </h6>
                        <p class="text-sm text-gray-700">Even home-based businesses may need a "Home Occupation Permit" to
                            ensure your business doesn't violate local residential zoning laws.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="sticky top-28">
                    <div class="bg-blue-700 text-white rounded-2xl p-6 shadow-lg mb-5">
                        <h5 class="text-lg font-bold mb-3">License Research Package</h5>
                        <p class="text-sm text-blue-100 mb-4">Don't guess which permits you need. Our experts research your
                            specific industry and zip code to provide a custom report.</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold">$99.00</span>
                            <span class="bg-white text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">One-Time</span>
                        </div>
                        <a href="{{ route('formation.start') }}"
                            class="block w-full bg-white text-blue-700 text-center py-2.5 rounded-lg font-bold transition-all hover:bg-gray-100">
                            Add to My Order
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                        <h6 class="font-bold mb-3">Essential Next Steps</h6>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('web.startup-cost-calculator') }}"
                                    class="text-sm text-blue-700 hover:text-blue-800 transition-colors">
                                    <i class="fa-solid fa-arrow-right mr-1.5 text-xs"></i>Estimate Startup Costs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.forms-library') }}"
                                    class="text-sm text-blue-700 hover:text-blue-800 transition-colors">
                                    <i class="fa-solid fa-arrow-right mr-1.5 text-xs"></i>Download Legal Forms
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
