@extends('web.layouts.app')

@section('title', 'Forms & Documents Library | StateFilingDeadlines')

@section('meta_description', 'Access official Secretary of State forms and internal governance templates for your business.')

@push('styles')
    <style>
        .form-card-hover:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush

@section('content')
    <!-- Standardized Hero -->
    <header class="bg-slate-900 text-white py-20 md:py-24 text-center md:text-left">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Forms & Documents Library</h1>
                <p class="text-lg md:text-xl text-slate-400">Access official Secretary of State forms and internal governance templates for your business.</p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 pb-20">
        <!-- Floating Filter Bar -->
        <div class="max-w-6xl mx-auto -mt-10 md:-mt-12">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Filter by State</label>
                        <select id="stateSelect" class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none" onchange="applyFilters()">
                            <option value="all">All States & Federal</option>
                            @foreach($states as $state)
                                <option value="{{ strtolower($state->state_name) }}">{{ $state->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Search Forms</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" id="formSearch" class="w-full border border-slate-300 rounded-lg pl-10 pr-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="e.g. 'Articles of Organization'..." onkeyup="applyFilters()">
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Entity Type</label>
                        <select id="entitySelect" class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none" onchange="applyFilters()">
                            <option value="all">All Entities</option>
                            <option value="llc">LLC</option>
                            <option value="corporation">Corporation</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-12">
            <!-- Forms Grid -->
            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="formsGrid">
                    @foreach($forms as $form)
                        <div class="form-card-wrapper"
                            data-state="{{ $form->state ? strtolower($form->state->state_name) : 'all' }}"
                            data-entity="{{ strtolower($form->entity_type) }}">
                            <div class="form-card-hover bg-white border border-slate-200 rounded-2xl p-6 h-full flex flex-col transition-all duration-300 hover:border-blue-500 hover:shadow-xl group">
                                <div class="flex justify-between items-start mb-5">
                                    <div class="w-12 h-12 bg-red-50 text-red-500 rounded-xl flex items-center justify-center text-xl">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <span class="text-[10px] font-bold uppercase px-2.5 py-1 rounded-md {{ !$form->state ? 'bg-slate-100 text-slate-500' : 'bg-blue-50 text-blue-600' }}">
                                        {{ $form->state ? $form->state->state_name : 'Universal' }}
                                    </span>
                                </div>
                                <h5 class="text-lg font-bold text-slate-900 mb-1 group-hover:text-blue-600 transition-colors">{{ $form->form_name }}</h5>
                                @if($form->form_number)
                                    <div class="text-[11px] text-slate-400 font-bold mb-3 uppercase tracking-wider">{{ $form->form_number }}</div>
                                @endif
                                <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">{{ $form->description }}</p>
                                <a href="{{ $form->download_url ?: '#' }}" target="_blank" class="w-full bg-slate-50 border border-slate-200 text-slate-900 font-bold py-2.5 rounded-lg text-sm text-center transition-all hover:bg-blue-50 hover:border-blue-300 hover:text-blue-700 flex items-center justify-center">
                                    <i class="fa-solid fa-download mr-2"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="text-center py-20 hidden">
                    <div class="w-20 h-20 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-folder-open text-3xl"></i>
                    </div>
                    <h5 class="text-lg font-bold text-slate-600">No forms found</h5>
                    <p class="text-slate-400 text-sm">Try adjusting your filters or search terms.</p>
                </div>
            </div>

            <!-- Consistent Sidebar -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white border-2 border-blue-600 rounded-2xl p-6 shadow-sm">
                        <h5 class="text-lg font-bold text-slate-900 flex items-center mb-3">
                            <i class="fa-solid fa-wand-magic-sparkles text-blue-600 mr-2"></i> Filing Made Easy
                        </h5>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">Why manually fill out complex PDFs? Our automated system handles the data entry and state submission for you.</p>
                        <a href="{{ route('formation.start') }}" class="block w-full bg-blue-600 text-white text-center font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Automate This Filing
                        </a>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h6 class="font-bold text-slate-900 mb-4">Quick Resources</h6>
                        <ul class="space-y-3 text-sm">
                            <li>
                                <a href="/resources/registered-agent-guide" class="flex items-center text-slate-600 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-chevron-right text-[10px] mr-2 opacity-50"></i> Agent Requirements
                                </a>
                            </li>
                            <li>
                                <a href="/compliance-calendar" class="flex items-center text-slate-600 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-chevron-right text-[10px] mr-2 opacity-50"></i> Deadlines Calendar
                                </a>
                            </li>
                            <li>
                                <a href="/resources/startup-cost-calculator" class="flex items-center text-slate-600 hover:text-blue-600 transition">
                                    <i class="fa-solid fa-chevron-right text-[10px] mr-2 opacity-50"></i> Cost Calculator
                                </a>
                            </li>
                        </ul>
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
            const search = document.getElementById('formSearch').value.toLowerCase();

            const cards = document.querySelectorAll('.form-card-wrapper');
            let count = 0;

            cards.forEach(card => {
                const cardState = card.getAttribute('data-state');
                const cardEntity = card.getAttribute('data-entity');
                const text = card.innerText.toLowerCase();

                const stateMatch = (state === 'all' || cardState === state || cardState === 'all');
                const entityMatch = (entity === 'all' || cardEntity === entity || cardEntity === 'all');
                const searchMatch = text.includes(search);

                if (stateMatch && entityMatch && searchMatch) {
                    card.style.display = "block";
                    count++;
                } else {
                    card.style.display = "none";
                }
            });

            document.getElementById('emptyState').classList.toggle('hidden', count > 0);
            document.getElementById('formsGrid').classList.toggle('hidden', count === 0);
        }
    </script>
@endpush