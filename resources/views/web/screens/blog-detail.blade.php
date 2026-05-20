@extends('web.layouts.app')

@section('title', $blog->seo_title ?? $blog->title . ' – StateFilingDeadlines')

@section('meta_description', $blog->seo_description ?? ($blog->excerpt ?? strip_tags(Str::limit($blog->content, 160))))

@section('meta_keywords', $blog->seo_keywords ?? '')

@if ($blog->canonical_url)
    @section('canonical', $blog->canonical_url)
@endif

@section('page_badge')
    <a href="{{ route('web.blog') }}" class="hover:text-white transition-colors">Blog</a>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
    <span>Article</span>
@endsection

@section('page_title', $blog->title)

@section('page_subtitle')
    <div class="flex items-center justify-center gap-4 text-white/70 text-sm">
        @if ($blog->published_at)
            <span>{{ $blog->published_at->format('F d, Y') }}</span>
        @endif
        @if ($blog->author)
            <span>•</span>
            <span>{{ $blog->author->name }}</span>
        @endif
    </div>
@endsection

@section('content')

    <!-- BLOG CONTENT -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- LEFT: Blog Content -->
                <div class="lg:col-span-8">

                    @if ($blog->featured_image)
                        <div class="mb-8 rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                alt="{{ $blog->featured_image_alt ?? $blog->title }}" class="w-full h-auto">
                        </div>
                    @endif

                    <!-- Categories & Tags -->
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        @foreach ($blog->categories as $category)
                            <a href="{{ route('web.blog', ['category' => $category->slug]) }}"
                                class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-full hover:bg-blue-200 transition-colors">{{ $category->name }}</a>
                        @endforeach
                        @foreach ($blog->tags as $tag)
                            <a href="{{ route('web.blog', ['tag' => $tag->slug]) }}"
                                class="inline-block px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-gray-200 transition-colors">{{ $tag->name }}</a>
                        @endforeach
                    </div>

                    <!-- Article Content -->
                    <article
                        class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-blue-600 prose-img:rounded-xl">
                        {!! $blog->content !!}
                    </article>

                    <!-- Share -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h4 class="font-semibold text-gray-900 mb-3">Share this article</h4>
                        <div class="flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}&url={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="px-4 py-2 bg-sky-500 text-white text-sm rounded-lg hover:bg-sky-600 transition-colors">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}"
                                target="_blank"
                                class="px-4 py-2 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-800 transition-colors">LinkedIn</a>
                        </div>
                    </div>

                </div>

                <!-- RIGHT: Sidebar -->
                <aside class="lg:col-span-4 space-y-6">

                    <!-- Search Box -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Search</h3>
                        <form action="{{ route('web.blog') }}" method="GET">
                            <div class="flex">
                                <input type="text" name="search" placeholder="Search articles..."
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

                    <!-- Recent Posts -->
                    @if ($recentPosts->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Posts</h3>
                            <ul class="space-y-3">
                                @foreach ($recentPosts as $recent)
                                    <li>
                                        <a href="{{ route('web.blog-detail', $recent->slug) }}"
                                            class="flex items-start gap-3 group">
                                            @if ($recent->featured_image)
                                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $recent->featured_image) }}"
                                                        alt="{{ $recent->title }}" class="w-full h-full object-cover">
                                                </div>
                                            @endif
                                            <div>
                                                <h4
                                                    class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors leading-snug">
                                                    {{ Str::limit($recent->title, 50) }}</h4>
                                                @if ($recent->published_at)
                                                    <span
                                                        class="text-xs text-gray-400">{{ $recent->published_at->format('M d, Y') }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Categories -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Categories</h3>
                        <ul class="space-y-2">
                            @foreach ($blogCategories as $category)
                                <li>
                                    <a href="{{ route('web.blog', ['category' => $category->slug]) }}"
                                        class="flex items-center justify-between text-gray-600 hover:text-blue-600 transition-colors">
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
                                @endphp
                                <li>
                                    <a href="{{ route('web.blog', ['year' => $archive->year, 'month' => $archive->month]) }}"
                                        class="flex items-center justify-between text-gray-600 hover:text-blue-600 transition-colors">
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
                                    class="inline-block px-3 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-full hover:bg-blue-100 hover:text-blue-700 transition-colors">{{ $tag->name }}</a>
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
