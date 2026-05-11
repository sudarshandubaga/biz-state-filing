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
</head>

<body>
    <header class="bg-blue-900 py-2">
        <div class="container mx-auto px-4 flex justify-end items-center space-x-4">
            @auth('web')
                <span class="text-blue-200 text-sm">{{ auth()->user()->full_name }}</span>
                <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-white hover:text-blue-200 text-sm font-medium transition-colors">Logout</button>
                </form>
            @else
                <a href="{{ route('auth.login') }}"
                    class="text-white hover:text-blue-200 text-sm font-medium transition-colors">Log In</a>
                <a href="{{ route('auth.register') }}"
                    class="text-white hover:text-blue-200 text-sm font-medium transition-colors">Register</a>
            @endauth
        </div>
    </header>
    <nav class="bg-white sticky top-0 z-50 shadow">
        <div class="container mx-auto py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ getSetting('logo') ? asset('uploads/settings/' . getSetting('logo')) : asset('imgs/logo.webp') }}"
                        alt="{{ getSetting('site_name') }}" class="h-16">
                </a>
                <button id="mobile-menu-toggle" class="mobile-menu-toggle lg:hidden"
                    aria-label="Toggle navigation menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-semibold">

                    <!-- STATES -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.states') }}" data-bs-toggle="dropdown">
                            States
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('web.states') }}">All States</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @foreach ($navStates ?? [] as $navState)
                                <li><a class="dropdown-item"
                                        href="{{ route('web.state-detail', $navState->state_slug) }}">{{ $navState->state_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- ENTITY TYPES -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.entity-types') }}"
                            data-bs-toggle="dropdown">
                            Entity Types
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('web.entity-types') }}">All Entity Types</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @foreach ($navEntityTypes ?? [] as $navEntityType)
                                <li><a class="dropdown-item"
                                        href="{{ route('web.entity-type-detail', $navEntityType->slug) }}">{{ $navEntityType->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- INDUSTRIES -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('web.industries') }}"
                            data-bs-toggle="dropdown">
                            Industries
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('web.industries') }}">All Industries</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @foreach ($navIndustries ?? [] as $navIndustry)
                                <li><a class="dropdown-item"
                                        href="{{ route('web.industry-detail', $navIndustry->slug) }}">{{ $navIndustry->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- COMPLIANCE -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.compliance-calendar') }}">Compliance Calendar</a>
                    </li>

                    <!-- TAX FORMS -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/tax-forms" data-bs-toggle="dropdown">
                            Tax Forms
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/tax-forms">All Tax Forms</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="https://www.irs.gov/forms-instructions" target="_blank">
                                    IRS Forms (Official)
                                </a></li>
                            <li><a class="dropdown-item" href="/state-tax-forms">State Tax Forms</a></li>
                        </ul>
                    </li>

                    <!-- RESOURCES -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Resources
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/business-license-requirements">Business License
                                    Requirements</a></li>
                            <li><a class="dropdown-item" href="/registered-agent-requirements">Registered Agent
                                    Requirements</a></li>
                            <li><a class="dropdown-item" href="/ein-guide">EIN Guide</a></li>
                            <li><a class="dropdown-item" href="/startup-cost-calculator">Startup Cost Calculator</a>
                            </li>
                            <li><a class="dropdown-item" href="/forms-library">Forms Library</a></li>
                        </ul>
                    </li>

                    <!-- BLOG -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.blog') }}">Blog</a>
                    </li>

                    <!-- ABOUT / PAGES -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($navPages ?? [] as $navPage)
                                <li><a class="dropdown-item"
                                        href="{{ route('web.page', $navPage->slug) }}">{{ $navPage->title }}</a>
                                </li>
                            @endforeach
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('web.contact') }}">Contact</a></li>
                        </ul>
                    </li>

                    <!-- Mobile Start My LLC Button -->
                    <li class="nav-item lg:hidden pt-2 pb-4">
                        <a href="{{ route('formation.start') }}"
                            class="button-primary w-full text-center block">Start My
                            LLC</a>
                    </li>

                </ul>
                <div class="ms-8 hidden lg:block">
                    <a href="{{ route('formation.start') }}" class="button-primary">Start My LLC</a>
                </div>
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
