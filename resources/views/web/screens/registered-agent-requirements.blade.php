@extends('web.layouts.app')

@section('title', 'Registered Agent Requirements by State | StateFilingDeadlines')
@section('meta_description',
    'Statutory requirements, physical presence rules, and official statutes for registered
    agents in all 50 states. Find your state\'s requirements.')

@section('page_title', 'Registered Agent Requirements')

@section('page_subtitle', 'Statutory requirements, physical presence rules, and official statutes for all 50 states.')

@section('content')

    <!-- Main Content -->
    <div class="container mx-auto px-4 pb-12" style="margin-top: -40px;">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Column -->
            <div class="lg:col-span-8">

                <!-- Search Box -->
                <div class="bg-white rounded-2xl border border-gray-200 p-7 shadow-sm mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-7">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">SEARCH BY
                                STATE</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 bg-white border border-r-0 border-gray-300 rounded-l-lg text-gray-400">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="stateInput"
                                    class="flex-1 block w-full px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none"
                                    placeholder="Start typing state name..." onkeyup="filterList()">
                            </div>
                        </div>
                        <div class="md:col-span-5">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">QUICK
                                JUMP</label>
                            <select id="stateSelect"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-700 focus:border-blue-700 outline-none bg-white"
                                onchange="jumpTo(this.value)">
                                <option value="">Choose a State...</option>
                                <option value="arizona">Arizona</option>
                                <option value="arkansas">Arkansas</option>
                                <option value="california">California</option>
                                <option value="florida">Florida</option>
                                <option value="michigan">Michigan</option>
                                <option value="new-york">New York</option>
                                <option value="texas">Texas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- State Requirement List -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <div id="stateList">

                        <!-- Arizona -->
                        <div class="state-entry" id="arizona" data-name="arizona">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">Arizona</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Must be an individual resident or a business
                                        entity authorized to operate in AZ. A physical street address is mandatory.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">Statute
                                    § 29-3115</span>
                            </div>
                        </div>

                        <!-- Arkansas -->
                        <div class="state-entry" id="arkansas" data-name="arkansas">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">Arkansas</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Agent must be a resident of Arkansas or a
                                        domestic/foreign corporation with a physical office in-state.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">ACA
                                    § 4-20-105</span>
                            </div>
                        </div>

                        <!-- California -->
                        <div class="state-entry" id="california" data-name="california">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">California</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Agent must be a California resident or a
                                        corporation authorized to do business in CA with a physical street address in the
                                        state.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">Corp
                                    Code § 1502</span>
                            </div>
                        </div>

                        <!-- Florida -->
                        <div class="state-entry" id="florida" data-name="florida">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">Florida</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Agent must be a Florida resident or a business
                                        entity authorized to do business in FL. A physical street address is required.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">FS
                                    § 605.0113</span>
                            </div>
                        </div>

                        <!-- Michigan -->
                        <div class="state-entry" id="michigan" data-name="michigan">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">Michigan</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Resident agent must be an individual resident, a
                                        MI corporation, or a foreign corporation authorized to do business.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">LARA
                                    Rule 450.1241</span>
                            </div>
                        </div>

                        <!-- New York -->
                        <div class="state-entry" id="new-york" data-name="new york">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">New York</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Designated agent must have a physical office in
                                        NY. Note: NY SOS serves as default agent for service of process.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">NY
                                    BCL § 305</span>
                            </div>
                        </div>

                        <!-- Texas -->
                        <div class="state-entry" id="texas" data-name="texas">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 text-lg">Texas</div>
                                    <p class="text-sm text-gray-600 mt-0.5">Must be a Texas resident or a business entity
                                        authorized to do business in Texas with a physical registered office.</p>
                                </div>
                                <span
                                    class="flex-shrink-0 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">BOC
                                    § 5.201</span>
                            </div>
                        </div>

                    </div>

                    <!-- Empty State -->
                    <div id="noResult" class="hidden text-center py-12">
                        <i class="fa-solid fa-face-frown text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 mb-2">No state requirements found matching your search.</p>
                        <button class="text-sm text-blue-700 font-medium hover:underline" onclick="resetSearch()">View All
                            States</button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-gray-200 p-7 shadow-sm sticky top-28">
                    <h5 class="text-lg font-bold mb-3">Need a Professional Agent?</h5>
                    <p class="text-sm text-gray-600 mb-4">Filing as your own agent risks your personal privacy. Our 9-step
                        automation handles representation in any state.</p>

                    <ul class="space-y-2.5 mb-6">
                        <li class="flex items-start gap-2.5 text-sm">
                            <i class="fa-solid fa-check text-green-500 mt-0.5"></i>
                            100% Privacy Protection
                        </li>
                        <li class="flex items-start gap-2.5 text-sm">
                            <i class="fa-solid fa-check text-green-500 mt-0.5"></i>
                            Immediate Document Scans
                        </li>
                        <li class="flex items-start gap-2.5 text-sm">
                            <i class="fa-solid fa-check text-green-500 mt-0.5"></i>
                            Multi-State Dashboard
                        </li>
                    </ul>

                    <a href="{{ route('formation.start') }}"
                        class="block w-full bg-blue-700 hover:bg-blue-800 text-white text-center py-3 rounded-lg font-bold transition-all shadow-md">
                        Assign My Agent Now
                    </a>

                    <hr class="my-5">

                    <h6 class="font-bold text-sm mb-2">Related Resources</h6>
                    <div class="space-y-1">
                        <a href="{{ route('web.forms-library') }}"
                            class="block text-sm text-gray-600 hover:text-blue-700 py-1 transition-colors">Forms
                            Library</a>
                        <a href="{{ route('web.compliance-calendar') }}"
                            class="block text-sm text-gray-600 hover:text-blue-700 py-1 transition-colors">Compliance
                            Calendar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function filterList() {
                const input = document.getElementById('stateInput').value.toLowerCase();
                const entries = document.querySelectorAll('.state-entry');
                let visibleCount = 0;

                entries.forEach(entry => {
                    const stateName = entry.getAttribute('data-name');
                    if (stateName.includes(input)) {
                        entry.style.display = "";
                        visibleCount++;
                    } else {
                        entry.style.display = "none";
                    }
                });

                const noResult = document.getElementById('noResult');
                if (visibleCount === 0) {
                    noResult.classList.remove('hidden');
                } else {
                    noResult.classList.add('hidden');
                }
            }

            function jumpTo(id) {
                if (!id) return;
                const element = document.getElementById(id);
                if (element) {
                    resetSearch();
                    element.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    element.classList.add('bg-amber-50');
                    setTimeout(() => element.classList.remove('bg-amber-50'), 2000);
                }
            }

            function resetSearch() {
                document.getElementById('stateInput').value = "";
                filterList();
            }
        </script>
    @endpush

    <!-- Inline style for state entries -->
    <style>
        .state-entry {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.2s;
        }

        .state-entry:last-child {
            border-bottom: none;
        }

        .state-entry:hover {
            background-color: #f8fafc;
        }
    </style>
@endsection
