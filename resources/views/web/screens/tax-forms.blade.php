@extends('web.layouts.app')

@section('title', 'Find State Business Tax Forms & Filing Documents | StateFilingDeadlines')

@section('meta_description', 'Instant access to Official LLC, Corp, and Tax documents for every state. Find the forms you need to stay compliant.')

@section('content')
    <!-- Search Hero -->
    <header class="bg-slate-900 text-white py-20 text-center border-b-4 border-blue-600">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">State Form Finder</h1>
            <p class="text-lg md:text-xl text-slate-400 opacity-75">Instant access to Official LLC, Corp, and Tax documents for every state.</p>
        </div>
    </header>

    <!-- Main Search Controls -->
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto -mt-10 md:-mt-12 bg-white rounded-2xl p-6 md:p-8 shadow-2xl border border-slate-100">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-5">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <select id="stateSelect" class="w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" onchange="applyFilters()">
                            <option value="all">Select State...</option>
                            @foreach($states as $state)
                                <option value="{{ strtolower($state->state_name) }}">{{ $state->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="md:col-span-5">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <select id="entitySelect" class="w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all" onchange="applyFilters()">
                            <option value="all">Entity Type...</option>
                            <option value="llc">LLC (Limited Liability Co)</option>
                            <option value="corporation">C-Corp / S-Corp</option>
                            <option value="non-profit">Non-Profit</option>
                        </select>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Search
                    </button>
                </div>
            </div>
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                <a href="{{ route('web.forms-library') }}" class="px-5 py-2 rounded-full border border-slate-200 bg-white text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition">All Forms</a>
                <span class="px-5 py-2 rounded-full bg-blue-600 text-white text-sm font-bold shadow-md">Tax Forms</span>
                <span class="px-5 py-2 rounded-full border border-slate-200 bg-white text-sm text-slate-600 cursor-not-allowed opacity-50">Annual Reports</span>
                <span class="px-5 py-2 rounded-full border border-slate-200 bg-white text-sm text-slate-600 cursor-not-allowed opacity-50">Dissolution</span>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Results Column -->
            <div class="lg:col-span-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <h4 class="text-2xl font-bold text-slate-900">Recommended Results</h4>
                    <span class="text-slate-400 text-sm bg-slate-100 px-3 py-1 rounded-full">Showing {{ $forms->count() }} Official Forms</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="formsGrid">
                    @forelse($forms as $form)
                        <div class="form-card-wrapper" 
                             data-state="{{ $form->state ? strtolower($form->state->state_name) : 'all' }}" 
                             data-entity="{{ strtolower($form->entity_type) }}">
                            <div class="bg-white border border-slate-200 rounded-2xl p-6 h-full flex flex-col transition-all duration-300 hover:border-blue-500 hover:shadow-xl group">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 {{ str_contains(strtolower($form->form_name), 'tax') ? 'bg-emerald-50 text-emerald-500' : 'bg-red-50 text-red-500' }} rounded-xl flex items-center justify-center text-2xl">
                                        <i class="fa-solid {{ str_contains(strtolower($form->form_name), 'tax') ? 'fa-file-invoice-dollar' : 'fa-file-pdf' }}"></i>
                                    </div>
                                    <span class="text-[10px] font-bold uppercase px-2.5 py-1 rounded-md bg-blue-50 text-blue-600">
                                        {{ $form->state ? $form->state->state_name : 'Universal' }}
                                    </span>
                                </div>
                                <h5 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $form->form_name }}</h5>
                                <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">{{ $form->description }}</p>
                                <div class="space-y-2">
                                    <a href="{{ $form->download_url ?: '#' }}" target="_blank" class="w-full bg-slate-50 border border-slate-200 text-slate-900 font-bold py-2.5 rounded-lg text-sm text-center transition-all hover:bg-slate-200 flex items-center justify-center">
                                        <i class="fa-solid fa-download mr-2 text-xs"></i> Download PDF
                                    </a>
                                    <a href="#" class="w-full text-blue-600 font-bold py-2 text-sm text-center hover:text-blue-800 transition-all block">
                                        File Online →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20 bg-white border border-dashed border-slate-200 rounded-2xl">
                            <i class="fa-solid fa-magnifying-glass text-4xl text-slate-200 mb-4 block"></i>
                            <p class="text-slate-500">No tax forms found for the selected criteria.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="sticky top-24">
                    <div class="bg-gradient-to-b from-white to-slate-50 border border-slate-200 rounded-2xl p-8 shadow-sm text-center">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-200">
                            <i class="fa-solid fa-wand-magic-sparkles text-2xl"></i>
                        </div>
                        <h5 class="text-xl font-bold text-slate-900 mb-2">Skip the Paperwork</h5>
                        <p class="text-sm text-slate-500 leading-relaxed mb-8">Filling out PDFs by hand is slow and prone to errors. Use our 9-step automated filer.</p>
                        
                        <div class="bg-white border border-slate-100 rounded-xl p-4 mb-8 space-y-4 text-left">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i>
                                <span class="text-xs font-bold text-slate-700">Instant Data Validation</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i>
                                <span class="text-xs font-bold text-slate-700">Direct State Gateway</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-500 text-xs"></i>
                                <span class="text-xs font-bold text-slate-700">Audit-Ready Receipts</span>
                            </div>
                        </div>

                        <a href="{{ route('formation.start') }}" class="block w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Automate This Form
                        </a>
                        <p class="mt-4 text-[10px] uppercase font-bold text-slate-400 tracking-widest">Processing over 5,000 filings monthly</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function applyFilters() {
            const state = document.getElementById('stateSelect').value;
            const entity = document.getElementById('entitySelect').value;
            
            const cards = document.querySelectorAll('.form-card-wrapper');
            let count = 0;

            cards.forEach(card => {
                const cardState = card.getAttribute('data-state');
                const cardEntity = card.getAttribute('data-entity');

                const stateMatch = (state === 'all' || cardState === state || cardState === 'all');
                const entityMatch = (entity === 'all' || cardEntity === entity || cardEntity === 'all');

                if (stateMatch && entityMatch) {
                    card.style.display = "block";
                    count++;
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>
@endpush
