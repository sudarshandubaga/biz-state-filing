<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', getSetting('site_name', config('app.name', 'BizStateFiling.com')))</title>
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <link rel="icon"
        href="{{ getSetting('favicon') ? asset('uploads/settings/' . getSetting('favicon')) : asset('imgs/favicon.ico') }}"
        type="image/x-icon">
    @if (getSetting('header_scripts'))
        {!! getSetting('header_scripts') !!}
    @endif
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @stack('styles')
</head>

<body>
    <!-- ============================================
    TOPBAR: Auth, Contact, Start My LLC
    ============================================ -->
    <div class="topbar">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-9">
                <!-- Left: Contact info -->
                <div class="flex items-center gap-5">
                    <a href="{{ route('web.contact') }}"
                        class="text-gray-400 hover:text-white transition-colors flex items-center gap-1.5">
                        <i class="fa-solid fa-envelope text-[10px]"></i>
                        <span>Contact Us</span>
                    </a>
                    <span class="text-gray-600">|</span>
                    <span class="text-gray-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-clock text-[10px]"></i>
                        <span>Mon-Fri 9am-6pm</span>
                    </span>
                </div>

                <!-- Right: Auth + Start My LLC -->
                <div class="flex items-center gap-3">
                    @auth('web')
                        <span class="text-gray-300 text-xs">{{ auth()->user()->full_name }}</span>
                        <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-gray-400 hover:text-white text-xs transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('auth.login') }}"
                            class="text-gray-400 hover:text-white text-xs transition-colors">Log In</a>
                        <a href="{{ route('auth.register') }}"
                            class="text-gray-400 hover:text-white text-xs transition-colors">Register</a>
                    @endauth
                    <span class="text-gray-600">|</span>
                    <a href="{{ route('formation.start') }}"
                        class="inline-flex items-center gap-1.5 bg-gradient-to-r from-yellow-500 to-yellow-400 text-gray-900 px-3.5 py-1 rounded-md text-xs font-bold hover:from-yellow-400 hover:to-yellow-300 transition-all shadow-sm">
                        <i class="fa-solid fa-rocket"></i>
                        Start My LLC
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================
    MAIN NAVIGATION
    ============================================ -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="container mx-auto">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="navbar-logo flex-shrink-0">
                    <img src="{{ getSetting('logo') ? asset('uploads/settings/' . getSetting('logo')) : asset('imgs/logo.webp') }}"
                        alt="{{ getSetting('site_name') }}" class="h-12 w-auto">
                </a>

                <!-- Mobile Toggle -->
                <button id="mobile-menu-toggle" class="mobile-menu-toggle lg:hidden"
                    aria-label="Toggle navigation menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>

                <!-- Navigation Links -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <!-- ============================================
                    9. ABOUT (Dropdown)
                    ============================================ -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fa-solid fa-circle-info text-blue-600 mr-1.5 text-xs"></i>
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/about">ℹ️ About Us</a></li>
                            <li><a class="dropdown-item" href="/editorial-guidelines">📝 Editorial Guidelines</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('web.contact') }}">📧 Contact Us</a></li>
                            <li><a class="dropdown-item" href="/advertise">📢 Advertise</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/privacy-policy">🔒 Privacy Policy</a></li>
                            <li><a class="dropdown-item" href="/terms-of-service">📜 Terms of Service</a></li>
                        </ul>
                    </li>

                    <!-- ============================================
                    1. START A BUSINESS (Mega Menu)
                    ============================================ -->
                    <li class="nav-item mega-cols-4">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.start-business') }}">
                            <i class="fa-solid fa-store text-blue-600 mr-1.5 text-xs"></i>
                            Start a Business
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <!-- Column 1: Startup Guides -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Startup Guides</span>
                                    <a href="{{ route('web.start-business') }}"
                                        class="mega-menu-item mega-menu-item-bold">
                                        <i class="fa-solid fa-compass text-blue-500 mr-2"></i>Complete Startup Guide
                                    </a>
                                    <span class="mega-menu-subheading">Start a Business by State</span>
                                    @foreach (($navStates ?? [])->take(5) as $navState)
                                        <a href="{{ route('web.state-detail', $navState->state_slug) }}"
                                            class="mega-menu-item">Start in {{ $navState->state_name }}</a>
                                    @endforeach
                                    @if (($navStates ?? [])->count() > 5)
                                        <a href="{{ route('web.states') }}" class="mega-menu-highlight">View All States
                                            →</a>
                                    @endif
                                </div>

                                <!-- Column 2: Business Structures -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Choose a Structure</span>
                                    <a href="{{ route('web.entity-type-detail', 'llc') }}"
                                        class="mega-menu-item mega-menu-item-bold">
                                        <i class="fa-solid fa-shield text-green-500 mr-2"></i>LLC Guide
                                    </a>
                                    <a href="{{ route('web.entity-type-detail', 'c-corporation') }}"
                                        class="mega-menu-item">C Corporation Guide</a>
                                    <a href="{{ route('web.entity-type-detail', 's-corporation') }}"
                                        class="mega-menu-item">S Corporation Guide</a>
                                    <a href="{{ route('web.entity-type-detail', 'sole-proprietorship') }}"
                                        class="mega-menu-item">Sole Proprietorship Guide</a>
                                    <div class="mt-2 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-subheading">Entity Comparisons</span>
                                        <a href="/llc-vs-s-corp" class="mega-menu-item">LLC vs S Corp</a>
                                        <a href="/llc-vs-sole-proprietorship" class="mega-menu-item">LLC vs Sole
                                            Prop</a>
                                        <a href="/s-corp-vs-c-corp" class="mega-menu-item">S Corp vs C Corp</a>
                                    </div>
                                </div>

                                <!-- Column 3: Start by Industry -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">By Industry</span>
                                    <a href="/industry/restaurant" class="mega-menu-item"><i
                                            class="fa-solid fa-utensils text-orange-400 mr-2"></i>Restaurant</a>
                                    <a href="/industry/cleaning" class="mega-menu-item"><i
                                            class="fa-solid fa-broom text-blue-400 mr-2"></i>Cleaning</a>
                                    <a href="/industry/home-health-care" class="mega-menu-item"><i
                                            class="fa-solid fa-heart text-red-400 mr-2"></i>Home Health Care</a>
                                    <a href="/industry/consulting" class="mega-menu-item"><i
                                            class="fa-solid fa-lightbulb text-yellow-500 mr-2"></i>Consulting</a>
                                    <a href="/industry/construction" class="mega-menu-item"><i
                                            class="fa-solid fa-hard-hat text-gray-500 mr-2"></i>Construction</a>
                                    <a href="/industry/real-estate" class="mega-menu-item"><i
                                            class="fa-solid fa-building text-purple-500 mr-2"></i>Real Estate</a>
                                    <a href="{{ route('web.industries') }}" class="mega-menu-highlight">All
                                        Industries →</a>
                                </div>

                                <!-- Column 4: Planning Tools -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Planning Tools</span>
                                    <a href="/startup-cost-calculator" class="mega-menu-item">
                                        <i class="fa-solid fa-calculator text-blue-500 mr-2"></i>Cost Calculator
                                    </a>
                                    <a href="/ein-guide" class="mega-menu-item">
                                        <i class="fa-solid fa-file-lines text-green-500 mr-2"></i>EIN Guide
                                    </a>
                                    <a href="/business-license-requirements" class="mega-menu-item">
                                        <i class="fa-solid fa-clipboard text-purple-500 mr-2"></i>License
                                        Requirements
                                    </a>
                                    <a href="/business-name-search" class="mega-menu-item">
                                        <i class="fa-solid fa-magnifying-glass text-orange-500 mr-2"></i>Business
                                        Name Search
                                    </a>
                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <a href="{{ route('formation.start') }}"
                                            class="mega-menu-highlight flex items-center gap-2">
                                            <i class="fa-solid fa-rocket"></i> Start My LLC Now →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ============================================
                    2. STATES (Mega Menu)
                    ============================================ -->
                    <li class="nav-item mega-cols-5">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.states') }}">
                            <i class="fa-solid fa-map text-blue-600 mr-1.5 text-xs"></i>
                            States
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <!-- Column 1: Overview -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Explore States</span>
                                    <a href="{{ route('web.states') }}"
                                        class="mega-menu-item mega-menu-item-bold">All States</a>
                                    <a href="/top-states-for-business" class="mega-menu-item">Top States for
                                        Business</a>
                                    <a href="/state-filing-fees" class="mega-menu-item">Filing Fees & Requirements</a>
                                    <div class="mt-2 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-subheading">State Compliance</span>
                                        @foreach (($navStates ?? [])->take(3) as $navState)
                                            <a href="{{ route('web.state-detail', $navState->state_slug) }}/compliance"
                                                class="mega-menu-item">{{ $navState->state_name }} Compliance</a>
                                        @endforeach
                                        <a href="{{ route('web.compliance-calendar') }}"
                                            class="mega-menu-highlight">All Compliance Guides →</a>
                                    </div>
                                </div>

                                <!-- Column 2: Top States Featured -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Featured States</span>
                                    @php
                                        $topStates = ($navStates ?? [])
                                            ->whereIn('state_slug', ['florida', 'texas', 'california', 'new-york'])
                                            ->all();
                                    @endphp
                                    @forelse ($topStates as $navState)
                                        <a href="{{ route('web.state-detail', $navState->state_slug) }}"
                                            class="mega-menu-item mega-menu-item-bold flex items-center gap-2">
                                            <span
                                                class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[10px] font-bold">{{ substr($navState->state_name, 0, 2) }}</span>
                                            {{ $navState->state_name }}
                                        </a>
                                    @empty
                                        <a href="/florida" class="mega-menu-item mega-menu-item-bold"><span
                                                class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[10px] font-bold mr-2">FL</span>Florida</a>
                                        <a href="/texas" class="mega-menu-item mega-menu-item-bold"><span
                                                class="w-6 h-6 rounded-full bg-red-100 text-red-700 flex items-center justify-center text-[10px] font-bold mr-2">TX</span>Texas</a>
                                        <a href="/california" class="mega-menu-item mega-menu-item-bold"><span
                                                class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-[10px] font-bold mr-2">CA</span>California</a>
                                        <a href="/new-york" class="mega-menu-item mega-menu-item-bold"><span
                                                class="w-6 h-6 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center text-[10px] font-bold mr-2">NY</span>New
                                            York</a>
                                    @endforelse
                                    <a href="{{ route('web.states') }}" class="mega-menu-highlight mt-2">View All
                                        States →</a>
                                </div>

                                <!-- Column 3: LLC by State -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Start an LLC by State</span>
                                    @php
                                        $llcStates = ($navStates ?? [])->take(5)->all();
                                    @endphp
                                    @forelse ($llcStates as $navState)
                                        <a href="{{ route('web.state-detail', $navState->state_slug) }}/llc"
                                            class="mega-menu-item">{{ $navState->state_name }} LLC</a>
                                    @empty
                                        <a href="/florida/llc" class="mega-menu-item">Florida LLC</a>
                                        <a href="/texas/llc" class="mega-menu-item">Texas LLC</a>
                                        <a href="/california/llc" class="mega-menu-item">California LLC</a>
                                        <a href="/new-york/llc" class="mega-menu-item">New York LLC</a>
                                    @endforelse
                                    <a href="{{ route('web.states') }}" class="mega-menu-highlight">View All →</a>
                                </div>

                                <!-- Column 4: Incorporate -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Incorporate by State</span>
                                    <a href="/florida/c-corp" class="mega-menu-item">Florida Corporation</a>
                                    <a href="/texas/c-corp" class="mega-menu-item">Texas Corporation</a>
                                    <a href="/california/c-corp" class="mega-menu-item">California Corporation</a>
                                    <a href="/new-york/c-corp" class="mega-menu-item">New York Corporation</a>
                                    <a href="{{ route('web.states') }}" class="mega-menu-highlight">View All →</a>
                                </div>

                                <!-- Column 5: Deadlines -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Compliance & Deadlines</span>
                                    <a href="{{ route('web.compliance-calendar') }}"
                                        class="mega-menu-item mega-menu-item-bold">📅 Compliance Calendar</a>
                                    <a href="/florida/annual-report" class="mega-menu-item">Florida Annual Report</a>
                                    <a href="/texas/franchise-tax" class="mega-menu-item">Texas Franchise Tax</a>
                                    <a href="/california/annual-report" class="mega-menu-item">California Annual
                                        Report</a>
                                    <a href="/new-york/annual-report" class="mega-menu-item">New York Annual
                                        Report</a>
                                    <a href="/state-filing-fees" class="mega-menu-highlight mt-1">State Filing Fees
                                        →</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ============================================
                    3. ENTITY TYPES (Mega Menu)
                    ============================================ -->
                    <li class="nav-item mega-cols-4">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.entity-types') }}">
                            <i class="fa-solid fa-building text-blue-600 mr-1.5 text-xs"></i>
                            Entity Types
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <!-- Column 1: LLC -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">LLC</span>
                                    <a href="{{ route('web.entity-type-detail', 'llc') }}"
                                        class="mega-menu-item mega-menu-item-bold">What is an LLC</a>
                                    <a href="/llc-advantages" class="mega-menu-item">✅ Advantages</a>
                                    <a href="/llc-disadvantages" class="mega-menu-item">⚠️ Disadvantages</a>
                                    <a href="/llc-formation-steps" class="mega-menu-item">📋 Formation Steps</a>
                                    <span class="mega-menu-subheading">LLC by State</span>
                                    <a href="/florida/llc" class="mega-menu-item">Florida LLC</a>
                                    <a href="/texas/llc" class="mega-menu-item">Texas LLC</a>
                                    <a href="/california/llc" class="mega-menu-item">California LLC</a>
                                    <a href="{{ route('web.states') }}" class="mega-menu-highlight">All States →</a>
                                </div>

                                <!-- Column 2: C Corp & S Corp -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">C Corporation</span>
                                    <a href="{{ route('web.entity-type-detail', 'c-corporation') }}"
                                        class="mega-menu-item mega-menu-item-bold">C Corp Guide</a>
                                    <a href="/incorporation-steps" class="mega-menu-item">Incorporation Steps</a>
                                    <a href="/c-corp-by-state" class="mega-menu-item">Corporation by State</a>

                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-heading">S Corporation</span>
                                        <a href="{{ route('web.entity-type-detail', 's-corporation') }}"
                                            class="mega-menu-item mega-menu-item-bold">What is an S Corp</a>
                                        <a href="/s-corp-tax-benefits" class="mega-menu-item">💰 Tax Benefits</a>
                                        <a href="/s-corp-by-state" class="mega-menu-item">S Corp by State</a>
                                    </div>
                                </div>

                                <!-- Column 3: Other Types -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Other Structures</span>
                                    <a href="{{ route('web.entity-type-detail', 'sole-proprietorship') }}"
                                        class="mega-menu-item">Sole Proprietorship</a>
                                    <a href="{{ route('web.entity-type-detail', 'limited-partnership') }}"
                                        class="mega-menu-item">Limited Partnership</a>
                                    <a href="{{ route('web.entity-type-detail', 'llp') }}"
                                        class="mega-menu-item">LLP</a>
                                    <a href="{{ route('web.entity-type-detail', 'professional-llc') }}"
                                        class="mega-menu-item">Professional LLC</a>
                                    <a href="{{ route('web.entity-type-detail', 'nonprofit') }}"
                                        class="mega-menu-item">Nonprofit</a>
                                    <a href="{{ route('web.entity-types') }}" class="mega-menu-highlight mt-2">View
                                        All →</a>
                                </div>

                                <!-- Column 4: Comparisons -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Entity Comparisons</span>
                                    <a href="/llc-vs-s-corp" class="mega-menu-item mega-menu-item-bold">⚖️ LLC vs S
                                        Corp</a>
                                    <a href="/llc-vs-sole-proprietorship" class="mega-menu-item">LLC vs Sole Prop</a>
                                    <a href="/s-corp-vs-c-corp" class="mega-menu-item">S Corp vs C Corp</a>
                                    <a href="/llc-vs-corporation" class="mega-menu-item">LLC vs Corporation</a>
                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <a href="{{ route('formation.start') }}"
                                            class="mega-menu-highlight flex items-center gap-2">
                                            <i class="fa-solid fa-rocket"></i> Start Your LLC →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ============================================
                    4. INDUSTRIES (Mega Menu)
                    ============================================ -->
                    <li class="nav-item mega-cols-4">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.industries') }}">
                            <i class="fa-solid fa-chart-line text-blue-600 mr-1.5 text-xs"></i>
                            Industries
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <!-- Column 1: Overview -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Overview</span>
                                    <a href="{{ route('web.industries') }}"
                                        class="mega-menu-item mega-menu-item-bold">All Industries</a>
                                    <a href="/top-industries-for-startups" class="mega-menu-item">Top Industries for
                                        Startups</a>
                                    <div class="mt-2 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-subheading">Best Entity by Industry</span>
                                        <a href="/industry/restaurant/best-entity" class="mega-menu-item">Best for
                                            Restaurant</a>
                                        <a href="/industry/cleaning/best-entity" class="mega-menu-item">Best for
                                            Cleaning</a>
                                        <a href="/industry/home-health-care/best-entity" class="mega-menu-item">Best
                                            for Home Care</a>
                                        <a href="/industry/construction/best-entity" class="mega-menu-item">Best for
                                            Construction</a>
                                    </div>
                                </div>

                                <!-- Column 2: Popular Industries -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Popular Industries</span>
                                    <a href="/industry/restaurant" class="mega-menu-item mega-menu-item-bold"><i
                                            class="fa-solid fa-utensils text-orange-400 mr-2"></i>Restaurant</a>
                                    <a href="/industry/cleaning" class="mega-menu-item mega-menu-item-bold"><i
                                            class="fa-solid fa-broom text-blue-400 mr-2"></i>Cleaning</a>
                                    <a href="/industry/home-health-care" class="mega-menu-item mega-menu-item-bold"><i
                                            class="fa-solid fa-heart text-red-400 mr-2"></i>Home Health Care</a>
                                    <a href="/industry/construction" class="mega-menu-item"><i
                                            class="fa-solid fa-hard-hat text-gray-500 mr-2"></i>Construction</a>
                                    <a href="/industry/landscaping" class="mega-menu-item"><i
                                            class="fa-solid fa-leaf text-green-500 mr-2"></i>Landscaping</a>
                                    <a href="/industry/real-estate" class="mega-menu-item"><i
                                            class="fa-solid fa-building text-purple-500 mr-2"></i>Real Estate</a>
                                    <a href="/industry/retail" class="mega-menu-item"><i
                                            class="fa-solid fa-bag-shopping text-pink-500 mr-2"></i>Retail</a>
                                    <a href="{{ route('web.industries') }}" class="mega-menu-highlight">All
                                        Industries →</a>
                                </div>

                                <!-- Column 3: Startup Guides -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Startup Guides</span>
                                    <a href="/industry/restaurant" class="mega-menu-item">Start a Restaurant</a>
                                    <a href="/industry/cleaning" class="mega-menu-item">Start a Cleaning Company</a>
                                    <a href="/industry/home-health-care" class="mega-menu-item">Start a Home Care
                                        Agency</a>
                                    <a href="/industry/consulting" class="mega-menu-item">Start a Consulting
                                        Business</a>
                                    <a href="/industry/construction" class="mega-menu-item">Start a Construction
                                        Co.</a>
                                    <a href="/industry/landscaping" class="mega-menu-item">Start a Landscaping
                                        Business</a>
                                    <a href="/industry/real-estate" class="mega-menu-item">Start a Real Estate
                                        Firm</a>
                                </div>

                                <!-- Column 4: Resources -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Top Resources</span>
                                    <a href="/industry/restaurant" class="mega-menu-item mega-menu-item-bold">🍽️
                                        Restaurant Guide</a>
                                    <a href="/industry/cleaning" class="mega-menu-item mega-menu-item-bold">🧹
                                        Cleaning Guide</a>
                                    <a href="/industry/home-health-care" class="mega-menu-item mega-menu-item-bold">🏥
                                        Home Care Guide</a>
                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <a href="/startup-cost-calculator" class="mega-menu-highlight">📊 Startup Cost
                                            Calculator</a>
                                        <a href="/business-license-requirements" class="mega-menu-highlight mt-1">📋
                                            License Requirements</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ============================================
                    6. FORMS LIBRARY (Mega Menu)
                    ============================================ -->
                    <li class="nav-item mega-cols-4">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.forms-library') }}">
                            <i class="fa-solid fa-folder-open text-blue-600 mr-1.5 text-xs"></i>
                            Forms
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <!-- Column 1: State Forms -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">State Formation Forms</span>
                                    <a href="/forms/state/florida-articles-of-organization"
                                        class="mega-menu-item">Articles of Organization</a>
                                    <a href="/forms/state/florida-articles-of-incorporation"
                                        class="mega-menu-item">Articles of Incorporation</a>
                                    <a href="/forms/state/florida-operating-agreement"
                                        class="mega-menu-item">Operating Agreement</a>
                                    <a href="/forms/state/florida-corporate-bylaws" class="mega-menu-item">Corporate
                                        Bylaws</a>
                                    <a href="/forms/state/florida-certificate-of-formation"
                                        class="mega-menu-item">Certificate of Formation</a>
                                    <a href="{{ route('web.forms-library') }}" class="mega-menu-highlight">Browse All
                                        Forms →</a>
                                </div>

                                <!-- Column 2: Tax Forms -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Federal Tax Forms</span>
                                    <a href="/forms/federal/irs-form-2553" class="mega-menu-item">IRS 2553 (S Corp
                                        Election)</a>
                                    <a href="/forms/federal/irs-form-ss-4" class="mega-menu-item">IRS SS-4 (EIN
                                        App)</a>
                                    <a href="/forms/federal/irs-form-1065" class="mega-menu-item">IRS 1065
                                        (Partnership)</a>
                                    <a href="/forms/federal/irs-form-1120" class="mega-menu-item">IRS 1120 (Corp
                                        Tax)</a>
                                    <a href="/forms/federal/irs-form-1120-s" class="mega-menu-item">IRS 1120-S (S
                                        Corp)</a>
                                    <div class="mt-2 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-subheading">State Tax Forms</span>
                                        <a href="/forms/state/florida-tax-form" class="mega-menu-item">Florida Tax</a>
                                        <a href="/forms/state/texas-tax-form" class="mega-menu-item">Texas Tax</a>
                                        <a href="/forms/state/california-tax-form" class="mega-menu-item">California
                                            Tax</a>
                                    </div>
                                </div>

                                <!-- Column 3: Reports & Dissolution -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Annual Reports</span>
                                    <a href="/forms/state/florida-annual-report" class="mega-menu-item">Florida Annual
                                        Report</a>
                                    <a href="/forms/state/texas-annual-report" class="mega-menu-item">Texas Annual
                                        Report</a>
                                    <a href="/forms/state/california-annual-report" class="mega-menu-item">California
                                        Annual Report</a>
                                    <a href="/forms/state/new-york-annual-report" class="mega-menu-item">New York
                                        Annual Report</a>

                                    <div class="mt-2 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-heading">Dissolution</span>
                                        <a href="/forms/dissolution/llc-dissolution" class="mega-menu-item">LLC
                                            Dissolution</a>
                                        <a href="/forms/dissolution/corporate-dissolution"
                                            class="mega-menu-item">Corporate Dissolution</a>
                                        <a href="/forms/dissolution/certificate-of-cancellation"
                                            class="mega-menu-item">Certificate of Cancellation</a>
                                    </div>
                                </div>

                                <!-- Column 4: Quick Links -->
                                <div class="mega-menu-column">
                                    <span class="mega-menu-heading">Quick Links</span>
                                    <a href="/ein-guide" class="mega-menu-item mega-menu-item-bold">📄 EIN Guide</a>
                                    <a href="{{ route('web.tax-forms') }}"
                                        class="mega-menu-item mega-menu-item-bold">💰 All Tax Forms</a>
                                    <a href="/business-license-requirements" class="mega-menu-item">📋 License
                                        Requirements</a>
                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <span class="mega-menu-subheading">Popular State Forms</span>
                                        <a href="/forms/state/florida-articles-of-organization"
                                            class="mega-menu-item">📄 Florida Articles of Org</a>
                                        <a href="/forms/state/texas-certificate-of-formation"
                                            class="mega-menu-item">📄 Texas Certificate</a>
                                        <a href="/forms/state/california-articles-of-organization"
                                            class="mega-menu-item">📄 California Articles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ============================================
                    5. COMPLIANCE CALENDAR (Dropdown)
                    ============================================ -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.compliance-calendar') }}">
                            <i class="fa-solid fa-calendar text-blue-600 mr-1.5 text-xs"></i>
                            Compliance
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('web.compliance-calendar') }}">📅 Business
                                    Compliance Calendar</a></li>
                            <li><a class="dropdown-item" href="/annual-report-deadlines">📄 Annual Report
                                    Deadlines</a></li>
                            <li><a class="dropdown-item" href="/franchise-tax-deadlines">💰 Franchise Tax
                                    Deadlines</a></li>
                            <li><a class="dropdown-item" href="/federal-filing-deadlines">🏛️ Federal Filing
                                    Deadlines</a></li>
                            <li><a class="dropdown-item" href="/state-filing-deadlines">🗺️ State Filing Deadlines</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/state-filing-fees">📋 Filing Fees & Requirements</a>
                            </li>
                        </ul>
                    </li>



                    <!-- ============================================
                    7. RESOURCES (Dropdown)
                    ============================================ -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fa-solid fa-book text-blue-600 mr-1.5 text-xs"></i>
                            Resources
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/business-license-requirements">📋 License
                                    Requirements</a></li>
                            <li><a class="dropdown-item" href="/registered-agent-requirements">👤 Registered Agent</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/ein-guide">📄 EIN Guide</a></li>
                            <li><a class="dropdown-item" href="/startup-cost-calculator">💰 Cost Calculator</a></li>
                            <li><a class="dropdown-item" href="/business-name-search">🔍 Name Search</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/business-compliance-checklist">✅ Compliance
                                    Checklist</a></li>
                            <li><a class="dropdown-item" href="{{ route('web.forms-library') }}">📁 Forms Library</a>
                            </li>
                        </ul>
                    </li>

                    <!-- ============================================
                    8. BLOG (Simple Link)
                    ============================================ -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.blog') }}">
                            <i class="fa-solid fa-newspaper text-blue-600 mr-1.5 text-xs"></i>
                            Blog
                        </a>
                    </li>

                    <!-- Mobile Start My LLC (visible only on mobile) -->
                    <li class="nav-item lg:hidden pt-3 pb-4 px-4">
                        <a href="{{ route('formation.start') }}" class="button-primary w-full text-center block">
                            <i class="fa-solid fa-rocket mr-1.5"></i> Start My LLC
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">

                <div class="lg:col-span-4">
                    <h3 class="text-xl font-bold mb-4">StateFilingDeadlines</h3>
                    <p class="text-gray-400">Your trusted resource for business formation, licensing, and compliance.
                    </p>
                </div>

                <div class="lg:col-span-2">
                    <h4 class="font-bold mb-4 text-gray-300">Explore</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('web.states') }}"
                                class="text-gray-400 hover:text-white transition-colors">States</a></li>
                        <li><a href="{{ route('web.entity-types') }}"
                                class="text-gray-400 hover:text-white transition-colors">Entity Types</a></li>
                        <li><a href="{{ route('web.industries') }}"
                                class="text-gray-400 hover:text-white transition-colors">Industries</a></li>
                        <li><a href="{{ route('web.blog') }}"
                                class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-2">
                    <h4 class="font-bold mb-4 text-gray-300">Legal</h4>
                    <ul class="space-y-2">
                        @php
                            $legalPages = ($navPages ?? [])->filter(function ($p) {
                                return in_array($p->slug, ['privacy-policy', 'terms-conditions', 'disclaimer']);
                            });
                        @endphp
                        @foreach ($legalPages as $legalPage)
                            <li><a href="{{ route('web.page', $legalPage->slug) }}"
                                    class="text-gray-400 hover:text-white transition-colors">{{ $legalPage->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="lg:col-span-4">
                    <h4 class="font-bold mb-4 text-gray-300">Support</h4>
                    <ul class="space-y-2">
                        @php
                            $supportPages = ($navPages ?? [])->filter(function ($p) {
                                return in_array($p->slug, ['help-center', 'affiliate-disclosure']);
                            });
                        @endphp
                        @foreach ($supportPages as $supportPage)
                            <li><a href="{{ route('web.page', $supportPage->slug) }}"
                                    class="text-gray-400 hover:text-white transition-colors">{{ $supportPage->title }}</a>
                            </li>
                        @endforeach
                        <li><a href="{{ route('web.contact') }}"
                                class="text-gray-400 hover:text-white transition-colors">Contact Us</a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 StateFilingDeadlines — All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    @if (getSetting('footer_scripts'))
        {!! getSetting('footer_scripts') !!}
    @endif
    @include('web.partials.upgrade-modal')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
