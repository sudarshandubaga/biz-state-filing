@extends('web.layouts.app')

@section('title', '2026 National Compliance Calendar | StateFilingDeadlines')

@section('meta_description', 'Stay ahead of annual reports, tax deadlines, renewals, and compliance filings with our comprehensive compliance calendar.')

@section('meta_keywords', 'compliance calendar, business deadlines, annual report due dates, tax filing deadlines, state compliance')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        #accordionView {
            margin-top: 2rem;
        }

        .month-header {
            background-color: #1e293b;
            color: #ffffff;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem 0.75rem 0 0;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .deadline-row {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-top: none;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .deadline-row:hover {
            background-color: #f1f5f9;
            transform: translateX(4px);
            border-left: 4px solid #2563eb;
        }

        .deadline-row:last-child {
            border-radius: 0 0 0.75rem 0.75rem;
        }

        .state-pill {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 0.35rem 0.85rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            display: inline-block;
            letter-spacing: 0.025em;
        }

        .status-pill {
            font-size: 0.65rem;
            font-weight: 900;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            text-transform: uppercase;
            display: inline-block;
            letter-spacing: 0.05em;
        }

        .status-pill.critical { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .status-pill.upcoming { background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; }

        @media (max-width: 768px) {
            .deadline-row {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            .deadline-row:hover { transform: none; border-left: 1px solid #e2e8f0; }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <header class="bg-gradient-to-br from-slate-900 to-slate-800 py-20 md:py-24 text-center text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold">National Compliance Calendar</h1>
            <p class="text-lg md:text-xl opacity-75 mt-3">All 50 States. All Entity Types. One Master Schedule.</p>
        </div>
    </header>

    <div class="container mx-auto px-4 pb-20">
        <!-- Filter Bar -->
        <div class="max-w-5xl mx-auto -mt-10 md:-mt-12">
            <div class="bg-white border border-slate-200 rounded-xl p-6 md:p-8 shadow-xl">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Select State</label>
                        <select class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" id="filterState">
                            <option value="">All States</option>
                            @foreach($states as $state)
                                <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Entity Type</label>
                        <select class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" id="filterEntity">
                            <option value="">All Entities</option>
                            @foreach($entityTypes as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Month</label>
                        <select class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" id="filterMonth">
                            <option value="">All Year</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="button" class="w-full bg-slate-900 text-white rounded-lg px-4 py-2.5 text-sm font-bold hover:bg-slate-800 transition" id="applyFilter">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-12">
            <div class="lg:col-span-8">
                <div id="accordionView"></div>
                <div id="noResults" class="text-center py-16" style="display:none;">
                    <p class="text-slate-400 font-medium italic">No deadlines match your filters.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 bg-white border-2 border-blue-600 rounded-xl p-6 shadow-sm">
                    <h5 class="font-bold text-lg text-slate-900 flex items-center">
                        <i class="fa-solid fa-robot text-blue-600 mr-2"></i> Auto-Pilot Mode
                    </h5>
                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">Stop checking calendars manually. Our 9-step automation syncs with state databases to handle your filings automatically.</p>
                    <ul class="text-sm text-slate-600 mt-4 space-y-2">
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Registered Agent Alerts</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> Auto-Generated Reports</li>
                        <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2"></i> $0 Late Fee Guarantee</li>
                    </ul>
                    <a href="{{ route('formation.start') }}" class="block w-full mt-6 bg-blue-600 text-white text-center font-bold py-2.5 rounded-lg hover:bg-blue-700 transition">Enroll My Business</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const complianceData = @json($complianceData);
        const monthNames = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        function renderAccordionView(data) {
            const container = document.getElementById('accordionView');
            container.innerHTML = '';
            
            const grouped = {};
            data.forEach(d => {
                if (!grouped[d.month]) grouped[d.month] = [];
                grouped[d.month].push(d);
            });
            
            const monthKeys = Object.keys(grouped).sort((a, b) => a - b);
            
            monthKeys.forEach(monthIdx => {
                const events = grouped[monthIdx];
                const section = document.createElement('div');
                section.className = 'mb-10';
                
                section.innerHTML = `
                    <div class="month-header">
                        <span>${monthNames[monthIdx].toUpperCase()} 2026</span>
                        <span class="text-xs font-normal opacity-75">${events.length} Upcoming Events</span>
                    </div>
                    ${events.map(e => `
                        <div class="deadline-row">
                            <div class="w-full md:w-32 flex-shrink-0">
                                <span class="state-pill">${e.state}</span>
                            </div>
                            <div class="flex-grow md:px-6">
                                <div class="font-bold text-slate-900">${e.title}</div>
                                <div class="text-slate-500 text-xs">${e.desc}</div>
                            </div>
                            <div class="w-full md:w-28 text-center">
                                <div class="font-bold text-slate-800">${monthNames[e.month].substring(0,3)} ${e.day}</div>
                            </div>
                            <div class="w-full md:w-32 text-center">
                                <span class="status-pill ${e.status === 'urgent' ? 'critical' : 'upcoming'}">${e.status === 'urgent' ? 'Critical' : 'Upcoming'}</span>
                            </div>
                            <div class="w-full md:w-24 text-right">
                                <a href="{{ route('formation.start') }}" class="inline-block w-full text-center py-1 px-3 border border-blue-600 text-blue-600 rounded text-xs font-bold hover:bg-blue-600 hover:text-white transition">File</a>
                            </div>
                        </div>
                    `).join('')}
                `;
                container.appendChild(section);
            });
        }

        function filterAndRender() {
            const sf = document.getElementById('filterState').value.toLowerCase();
            const ef = document.getElementById('filterEntity').value.toLowerCase();
            const mf = document.getElementById('filterMonth').value;

            let filtered = complianceData.filter(d => {
                if (sf && d.state.toLowerCase() !== sf) return false;
                if (ef && d.entity.toLowerCase() !== ef && d.entity.toLowerCase() !== 'all') return false;
                if (mf && d.month != mf) return false;
                return true;
            });

            const av = document.getElementById('accordionView');
            const nr = document.getElementById('noResults');

            if (filtered.length === 0) {
                av.style.display = 'none';
                nr.style.display = 'block';
            } else {
                nr.style.display = 'none';
                av.style.display = 'block';
                renderAccordionView(filtered);
            }
        }

        document.getElementById('applyFilter').addEventListener('click', filterAndRender);
        document.getElementById('filterMonth').addEventListener('change', filterAndRender);
        document.getElementById('filterState').addEventListener('change', filterAndRender);
        document.getElementById('filterEntity').addEventListener('change', filterAndRender);
        
        filterAndRender();
    </script>
@endpush
