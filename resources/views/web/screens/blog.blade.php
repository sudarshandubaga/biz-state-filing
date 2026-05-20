@extends('web.layouts.app')

@section('title', 'Business Blog – Formation, Compliance & Filing Tips – StateFilingDeadlines')

@section('meta_description',
    'Expert articles on business formation, annual compliance, state filing deadlines,
    licenses, permits, and more.')

@section('meta_keywords',
    'business blog, LLC guide, business formation tips, compliance deadlines, business license
    guide')

@section('page_badge')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
        </path>
    </svg>
    Blog
@endsection

@section('page_title', 'Business Blog')

@section('page_subtitle', 'Expert articles on business formation, compliance, state filing deadlines, and more.')

@section('content')

    <!-- BLOG CONTENT -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- LEFT: Blog Posts -->
                <div class="lg:col-span-8">
                    @if (request()->filled('search') ||
                            request()->filled('category') ||
                            request()->filled('tag') ||
                            request()->filled('year'))
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-gray-600">
                                @if (request()->filled('search'))
                                    Search results for: <strong>"{{ request('search') }}"</strong>
                                @elseif(request()->filled('category'))
                                    Category: <strong>{{ request('category') }}</strong>
                                @elseif(request()->filled('tag'))
                                    Tag: <strong>{{ request('tag') }}</strong>
                                @elseif(request()->filled('year') && request()->filled('month'))
                                    Archive: <strong>{{ DateTime::createFromFormat('m', request('month'))->format('F') }}
                                        {{ request('year') }}</strong>
                                @endif
                                <a href="{{ route('web.blog') }}" class="text-blue-600 hover:underline ml-2 text-sm">Clear
                                    filter</a>
                            </p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($blogs as $blog)
                            <article
                                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow group">
                                @if ($blog->featured_image)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                            alt="{{ $blog->featured_image_alt ?? $blog->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @endif
                                <div class="p-5">
                                    <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                        @if ($blog->published_at)
                                            <span>{{ $blog->published_at->format('M d, Y') }}</span>
                                        @endif
                                        @if ($blog->categories->count() > 0)
                                            <span>•</span>
                                            @foreach ($blog->categories as $category)
                                                <a href="{{ route('web.blog', ['category' => $category->slug]) }}"
                                                    class="text-blue-600 hover:underline">{{ $category->name }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-900 leading-snug mb-2">
                                        <a href="{{ route('web.blog-detail', $blog->slug) }}"
                                            class="hover:text-blue-600 transition-colors">
                                            {{ $blog->title }}
                                        </a>
                                    </h2>
                                    <p class="text-gray-500 text-sm leading-relaxed">
                                        {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}</p>
                                    <a href="{{ route('web.blog-detail', $blog->slug) }}"
                                        class="inline-flex items-center gap-1 text-blue-600 font-semibold text-sm mt-3 hover:gap-2 transition-all">
                                        Read More
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                                <p class="text-gray-500">No blog posts found.</p>
                                @if (request()->anyFilled(['search', 'category', 'tag', 'year']))
                                    <a href="{{ route('web.blog') }}"
                                        class="text-blue-600 hover:underline text-sm mt-2 inline-block">View all posts</a>
                                @endif
                            </div>
                        @endforelse
                    </div>

                    @if ($blogs->hasPages())
                        <div class="mt-8">
                            {{ $blogs->links() }}
                        </div>
                    @endif
                </div>

                <!-- RIGHT: Sidebar -->
                <aside class="lg:col-span-4 space-y-6">

                    <!-- Search Box -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Search</h3>
                        <form action="{{ route('web.blog') }}" method="GET">
                            @if (request()->filled('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if (request()->filled('tag'))
                                <input type="hidden" name="tag" value="{{ request('tag') }}">
                            @endif
                            @if (request()->filled('year') && request()->filled('month'))
                                <input type="hidden" name="year" value="{{ request('year') }}">
                                <input type="hidden" name="month" value="{{ request('month') }}">
                            @endif
                            <div class="flex">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search articles..."
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @foreach ($blogCategories as $category)
                                <li>
                                    <a href="{{ route('web.blog', ['category' => $category->slug]) }}"
                                        class="flex items-center justify-between text-gray-600 hover:text-blue-600 transition-colors {{ request('category') == $category->slug ? 'text-blue-600 font-semibold' : '' }}">
                                        <span>{{ $category->name }}</span>
                                        <span
                                            class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-full">{{ $category->blogs_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Archive -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Archive</h3>
                        <ul class="space-y-2">
                            @forelse($archives as $archive)
                                @php
                                    $monthName = DateTime::createFromFormat(
                                        'm',
                                        str_pad($archive->month, 2, '0', STR_PAD_LEFT),
                                    )->format('F');
                                    $isActive =
                                        request('year') == $archive->year && request('month') == $archive->month;
                                @endphp
                                <li>
                                    <a href="{{ route('web.blog', ['year' => $archive->year, 'month' => $archive->month]) }}"
                                        class="flex items-center justify-between text-gray-600 hover:text-blue-600 transition-colors {{ $isActive ? 'text-blue-600 font-semibold' : '' }}">
                                        <span>{{ $monthName }} {{ $archive->year }}</span>
                                        <span
                                            class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-full">{{ $archive->count }}</span>
                                    </a>
                                </li>
                            @empty
                                <li class="text-gray-400 text-sm">No archived posts yet.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($blogTags as $tag)
                                <a href="{{ route('web.blog', ['tag' => $tag->slug]) }}"
                                    class="inline-block px-3 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-blue-100 hover:text-blue-700 transition-colors {{ request('tag') == $tag->slug ? 'bg-blue-100 text-blue-700' : '' }}">
                                    {{ $tag->name }}
                                </a>
                            @empty
                                <span class="text-gray-400 text-sm">No tags yet.</span>
                            @endforelse
                        </div>
                    </div>

                </aside>

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
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Start Your Business for $0 + State Fees</h2>
                <p class="text-lg text-blue-200 mb-8 max-w-xl mx-auto">Recommended partner for fast, affordable business
                    formation.</p>
                <a href="/start-llc"
                    class="inline-flex items-center gap-2 bg-white text-blue-900 font-bold px-8 py-4 rounded-lg hover:bg-blue-50 transition-colors shadow-xl">
                    Start Now
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
