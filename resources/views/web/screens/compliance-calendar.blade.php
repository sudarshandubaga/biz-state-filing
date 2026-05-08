@extends('web.layouts.app')

@section('title', 'Compliance Calendar – StateFilingDeadlines')

@section('meta_description', 'Stay ahead of annual reports, tax deadlines, renewals, and compliance filings with our
    comprehensive compliance calendar.')

@section('meta_keywords', 'compliance calendar, business deadlines, annual report due dates, tax filing deadlines, state
    compliance')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative min-h-[350px] flex items-center bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE4YzEuNjU3IDAgMy0xLjM0MyAzLTNzLTEuMzQzLTMtMy0zLTMgMS4zNDMtMyAzIDEuMzQzIDMgMyAzem0wIDM2YzEuNjU3IDAgMy0xLjM0MyAzLTNzLTEuMzQzLTMtMy0zLTMgMS4zNDMtMyAzIDEuMzQzIDMgMyAzek0xOCAzNmMxLjY1NyAwIDMtMS4zNDMgMy0zcy0xLjM0My0zLTMtMy0zIDEuMzQzLTMgMyAxLjM0MyAzIDMgM3oiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-30">
        </div>
        <div class="relative container mx-auto px-4 py-16">
            <div class="max-w-3xl mx-auto text-center">
                <div
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-sm font-medium px-4 py-2 rounded-full mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    Stay Informed & Compliant
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    Compliance Calendar
                </h1>
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto">
                    Stay ahead of annual reports, tax deadlines, renewals, and compliance filings — all in one place.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- ADVERTISEMENT SECTION -->
    <section class="py-6">
        <div class="container mx-auto px-4">
            <div
                class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-gray-300 transition-colors">
                <strong class="text-gray-400 text-sm uppercase tracking-wider">Advertisement</strong><br>
                <span class="text-gray-300 text-sm">728×90 Banner Ad Placement</span>
            </div>
        </div>
    </section>

    <!-- WHY COMPLIANCE MATTERS -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Why Compliance Matters</h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Every business must meet state, federal, and local compliance deadlines to avoid penalties,
                    late fees, or administrative dissolution. Our compliance calendar helps you track important
                    filing dates throughout the year so you never miss a critical deadline.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Avoid Penalties</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Late filings can result in costly penalties,
                            interest charges, and legal consequences for your business.</p>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-amber-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Protect Your Business</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Stay compliant to maintain good standing and avoid
                            administrative dissolution or revocation of licenses.</p>
                    </div>
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Stay Organized</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Track all your important filing dates in one place
                            with our comprehensive compliance calendar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ANNUAL COMPLIANCE CALENDAR -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Annual Compliance Calendar</h2>
                    <p class="text-gray-500 mt-1">Key deadlines organized by month to keep your business on track.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">

                <!-- JANUARY -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            January
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Jan 15:</span>
                                <span class="text-gray-600">Estimated quarterly tax payment due.</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-orange-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Jan 31:</span>
                                <span class="text-gray-600">Send W‑2 and 1099 forms to employees/contractors.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FEBRUARY -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            February
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-orange-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Feb 28:</span>
                                <span class="text-gray-600">File 1099‑NEC and 1099‑MISC with IRS (paper filing).</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MARCH -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            March
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Mar 15:</span>
                                <span class="text-gray-600">S‑Corp and Partnership tax returns due.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- APRIL -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-violet-500 to-violet-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            April
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Apr 15:</span>
                                <span class="text-gray-600">Individual and C‑Corp tax returns due.</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Apr 15:</span>
                                <span class="text-gray-600">Q1 estimated tax payment due.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MAY -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-pink-500 to-pink-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            May
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-amber-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">May 15:</span>
                                <span class="text-gray-600">Annual report filings due for many states (check state-specific
                                    deadlines).</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JUNE -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            June
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Jun 15:</span>
                                <span class="text-gray-600">Q2 estimated tax payment due.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JULY -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-rose-500 to-rose-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            July
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Jul 31:</span>
                                <span class="text-gray-600">Mid-year compliance check — verify business licenses and
                                    permits.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AUGUST -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            August
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-amber-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Aug 15:</span>
                                <span class="text-gray-600">Extension filers — S‑Corp and Partnership returns due.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEPTEMBER -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            September
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Sep 15:</span>
                                <span class="text-gray-600">Q3 estimated tax payment due.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OCTOBER -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            October
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-amber-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Oct 15:</span>
                                <span class="text-gray-600">Extension filers — Individual and C‑Corp returns due.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NOVEMBER -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-gray-500 to-gray-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            November
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Nov 1:</span>
                                <span class="text-gray-600">Begin preparing year-end tax planning and compliance
                                    review.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DECEMBER -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            December
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Dec 15:</span>
                                <span class="text-gray-600">Q4 estimated tax payment due.</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2 flex-shrink-0"></div>
                            <div>
                                <span class="font-semibold text-gray-900">Dec 31:</span>
                                <span class="text-gray-600">Year-end compliance review — prepare for upcoming year
                                    filings.</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- LEGEND -->
    <section class="py-10 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Deadline Type Legend</h3>
                <div class="flex flex-wrap justify-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="text-sm text-gray-600">Tax Deadline</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                        <span class="text-sm text-gray-600">Form Filing</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                        <span class="text-sm text-gray-600">Annual Report</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-sm text-gray-600">Compliance Check</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATE-SPECIFIC DEADLINES -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">State‑Specific Compliance Deadlines</h2>
                </div>
                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto mb-8">
                    Each state has its own annual report deadlines, franchise tax due dates, and renewal requirements.
                    Browse our state-specific pages for detailed information.
                </p>
                <a href="/states"
                    class="inline-flex items-center gap-2 bg-white text-blue-800 font-semibold px-6 py-3 rounded-lg border-2 border-blue-800 hover:bg-blue-800 hover:text-white transition-colors">
                    View State Deadlines
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- SET COMPLIANCE REMINDERS -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 md:p-12 border border-blue-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Set Compliance Reminders</h2>
                    </div>
                    <p class="text-lg text-gray-600 leading-relaxed mb-8">
                        Never miss a deadline. Set up custom reminders for annual reports, tax filings, and renewals
                        so you always stay on top of your compliance obligations.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/compliance-reminders"
                            class="inline-flex items-center gap-2 bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Set Reminders
                        </a>
                        <a href="/help-center"
                            class="inline-flex items-center gap-2 bg-white text-gray-700 font-medium px-6 py-3 rounded-lg border border-gray-300 hover:border-gray-400 hover:text-gray-900 transition-colors">
                            Learn More
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
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
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Stay Compliant All Year</h2>
                <p class="text-lg text-blue-200 mb-8 max-w-xl mx-auto">
                    Our recommended partner helps you file annual reports, manage business licenses, and maintain compliance
                    effortlessly.
                </p>
                <a href="/start-llc"
                    class="inline-flex items-center gap-2 bg-white text-blue-900 font-bold px-8 py-4 rounded-lg hover:bg-blue-50 transition-colors shadow-xl">
                    Get Started Today
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
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
