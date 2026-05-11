<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - BizStateFiling</title>
    <link rel="icon"
        href="{{ getSetting('favicon') ? asset('uploads/settings/' . getSetting('favicon')) : asset('imgs/favicon.ico') }}"
        type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    @auth('admin')
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-800 text-white min-h-screen fixed left-0 top-0 overflow-y-auto">
                <div class="p-4 border-b border-gray-700">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Admin Panel</a>
                </div>
                <nav class="mt-2 pb-6">

                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    {{-- Location Group --}}
                    @php $locationActive = request()->routeIs('admin.countries.*') || request()->routeIs('admin.states.*'); @endphp
                    <div x-data="{ open: {{ $locationActive ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-4 py-3 {{ $locationActive ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Location
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="bg-gray-900">
                            <a href="{{ route('admin.countries.index') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.countries.*') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11m6-11v6m6-6v6m-2 0v-6" />
                                </svg>
                                Country
                            </a>
                            <a href="{{ route('admin.states.index') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.states.*') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                State
                            </a>
                        </div>
                    </div>

                    {{-- Industries --}}
                    <a href="{{ route('admin.industries.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.industries.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Industries
                    </a>

                    {{-- Entity Types --}}
                    <a href="{{ route('admin.entity-types.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.entity-types.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Entity Types
                    </a>

                    {{-- Pages --}}
                    <a href="{{ route('admin.pages.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pages.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Pages
                    </a>

                    {{-- Resources --}}
                    <a href="{{ route('admin.resources.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.resources.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Resources
                    </a>

                    {{-- Ads Management --}}
                    <a href="{{ route('admin.ads.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.ads.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z M20.488 9H15V3.512a9.025 9.025 0 015.488 5.488z" />
                        </svg>
                        Ads
                    </a>

                    {{-- Tax Forms --}}
                    <a href="{{ route('admin.tax-forms.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.tax-forms.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Tax Forms
                    </a>

                    {{-- Compliance Calendar --}}
                    <a href="{{ route('admin.compliance-deadlines.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.compliance-deadlines.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Compliance Calendar
                    </a>

                    {{-- Blog Group --}}
                    @php $blogActive = request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blog-tags.*'); @endphp
                    <div x-data="{ open: {{ $blogActive ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-4 py-3 {{ $blogActive ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                Blog
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="bg-gray-900">
                            <a href="{{ route('admin.blog-categories.index') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.blog-categories.*') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Blog Categories
                            </a>
                            <a href="{{ route('admin.blog-tags.index') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.blog-tags.*') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Blog Tags
                            </a>
                            <a href="{{ route('admin.blogs.index') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.blogs.*') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Blog
                            </a>
                        </div>
                    </div>

                    {{-- Leads --}}
                    <a href="{{ route('admin.leads.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.leads.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Leads
                    </a>

                    {{-- Affiliates --}}
                    <a href="{{ route('admin.affiliates.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.affiliates.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Affiliates
                    </a>

                    {{-- Admin Users --}}
                    <a href="{{ route('admin.admin-users.index') }}"
                        class="flex items-center px-4 py-3 {{ request()->routeIs('admin.admin-users.*') ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Admin Users
                    </a>

                    {{-- Settings Group --}}
                    @php $settingsActive = request()->routeIs('admin.profile') || request()->routeIs('admin.change-password') || request()->routeIs('admin.settings.*'); @endphp
                    <div x-data="{ open: {{ $settingsActive ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-4 py-3 {{ $settingsActive ? 'bg-gray-700' : '' }} hover:bg-gray-700 transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="bg-gray-900">
                            <a href="{{ route('admin.profile') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.profile') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Edit Profile
                            </a>
                            <a href="{{ route('admin.settings.edit') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.settings.*') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                </svg>
                                Site Settings
                            </a>
                            <a href="{{ route('admin.change-password') }}"
                                class="flex items-center pl-12 pr-4 py-2.5 text-sm {{ request()->routeIs('admin.change-password') ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                Change Password
                            </a>
                        </div>
                    </div>

                </nav>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Top Bar -->
                <header class="bg-white shadow">
                    <div class="flex items-center justify-between px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <div class="flex items-center">
                            <span class="text-gray-600 mr-4">{{ auth('admin')->user()->name }}</span>
                            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">Logout</button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-6">
                    @if (session('status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    @else
        @yield('content')
    @endauth

    @vite('resources/js/app.js')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>

</html>
