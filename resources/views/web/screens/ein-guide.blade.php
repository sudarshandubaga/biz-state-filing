@extends('web.layouts.app')

@section('title', 'EIN Guide: How to Get Your Tax ID | StateFilingDeadlines')

@section('meta_description', 'Your Employer Identification Number (EIN) is your business\'s social security number.
    Learn why you need it and how to secure one.')

@section('page_badge')
    <i class="fa-solid fa-file-invoice text-blue-400"></i>
    Tax ID Guide
@endsection

@section('page_title', 'Understanding the EIN')

@section('page_subtitle', 'Your Employer Identification Number (EIN) is your business\'s social security number. Learn
    why you need it and how to secure one.')

@section('content')

    <main class="container mx-auto px-4 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 -mt-10 md:-mt-12">
            <!-- Main Content Card -->
            <div class="lg:col-span-8">
                <div class="bg-white border border-slate-200 rounded-2xl p-8 md:p-10 shadow-2xl">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6">Do You Need an EIN?</h3>
                    <p class="text-slate-500 mb-8 leading-relaxed">Most new businesses require an EIN to operate legally in
                        the United States. Use this checklist to see if your entity qualifies:</p>

                    <div class="space-y-6">
                        <div
                            class="flex items-start gap-5 p-6 bg-slate-50 border border-slate-100 rounded-2xl transition-all hover:border-blue-200 hover:bg-white group">
                            <div
                                class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div>
                                <h6 class="text-lg font-bold text-slate-900 mb-1">You have employees</h6>
                                <p class="text-sm text-slate-500 leading-relaxed">Even if you only have one employee, the
                                    IRS requires an EIN for payroll tax reporting.</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-5 p-6 bg-slate-50 border border-slate-100 rounded-2xl transition-all hover:border-blue-200 hover:bg-white group">
                            <div
                                class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div>
                                <h6 class="text-lg font-bold text-slate-900 mb-1">You operate as a Corporation or
                                    Partnership</h6>
                                <p class="text-sm text-slate-500 leading-relaxed">While some single-member LLCs can use an
                                    SSN, all Corps and Partnerships must have a unique EIN.</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-5 p-6 bg-slate-50 border border-slate-100 rounded-2xl transition-all hover:border-blue-200 hover:bg-white group">
                            <div
                                class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div>
                                <h6 class="text-lg font-bold text-slate-900 mb-1">You want to open a Business Bank Account
                                </h6>
                                <p class="text-sm text-slate-500 leading-relaxed">Almost all financial institutions require
                                    an EIN to open an account under a business name.</p>
                            </div>
                        </div>
                    </div>

                    <div class="my-12 border-t border-slate-100"></div>

                    <h4 class="text-xl font-bold text-slate-900 mb-8">The Application Process</h4>
                    <div class="space-y-8">
                        <div class="flex items-start gap-6">
                            <div
                                class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                1</div>
                            <div>
                                <h6 class="text-lg font-bold text-slate-900 mb-1">Form SS-4</h6>
                                <p class="text-sm text-slate-500 leading-relaxed">The official document used to apply for an
                                    EIN. You can download this in our <a href="{{ route('web.forms-library') }}"
                                        class="text-blue-600 hover:underline font-semibold">Forms Library</a>.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-6">
                            <div
                                class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                2</div>
                            <div>
                                <h6 class="text-lg font-bold text-slate-900 mb-1">Responsible Party</h6>
                                <p class="text-sm text-slate-500 leading-relaxed">You must designate one individual (the
                                    "responsible party") who controls or manages the entity.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 p-6 bg-blue-50 border-l-4 border-blue-600 rounded-r-2xl">
                        <h6 class="text-blue-900 font-bold flex items-center mb-2">
                            <i class="fa-solid fa-lightbulb mr-2"></i> Important Note
                        </h6>
                        <p class="text-sm text-blue-800 leading-relaxed">The IRS only issues **one EIN per responsible party
                            per day**. If you are launching multiple companies, plan your filings accordingly.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Conversion Module -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm">
                        <h5 class="text-xl font-bold text-slate-900 mb-4">Obtain Your EIN Today</h5>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">Skip the IRS paperwork. We handle the SS-4
                            filing and deliver your official EIN confirmation digitally.</p>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center text-sm text-slate-600">
                                <i class="fa-solid fa-bolt text-amber-500 w-5"></i> Fast 24-Hour Processing
                            </li>
                            <li class="flex items-center text-sm text-slate-600">
                                <i class="fa-solid fa-shield-halved text-emerald-500 w-5"></i> Secure IRS Submission
                            </li>
                            <li class="flex items-center text-sm text-slate-600">
                                <i class="fa-solid fa-file-invoice-dollar text-blue-500 w-5"></i> Tax-Deductible Fee
                            </li>
                        </ul>

                        <a href="{{ route('formation.start') }}"
                            class="block w-full bg-blue-600 text-white text-center font-bold py-4 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Get My EIN Now
                        </a>
                    </div>

                    <div class="bg-slate-900 rounded-2xl p-8 text-white shadow-xl">
                        <h6 class="font-bold mb-4">Related Guides</h6>
                        <ul class="space-y-3 text-sm">
                            <li>
                                <a href="{{ route('web.forms-library') }}"
                                    class="flex items-center text-slate-400 hover:text-white transition">
                                    <i class="fa-solid fa-chevron-right text-[10px] mr-2 opacity-50"></i> Download Form SS-4
                                </a>
                            </li>
                            <li>
                                <a href="/resources/registered-agent"
                                    class="flex items-center text-slate-400 hover:text-white transition">
                                    <i class="fa-solid fa-chevron-right text-[10px] mr-2 opacity-50"></i> Registered Agent
                                    Guide
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.compliance-calendar') }}"
                                    class="flex items-center text-slate-400 hover:text-white transition">
                                    <i class="fa-solid fa-chevron-right text-[10px] mr-2 opacity-50"></i> Compliance
                                    Calendar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
