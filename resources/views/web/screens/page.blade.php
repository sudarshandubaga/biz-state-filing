@extends('web.layouts.app')

@section('title', $page->seo_title ?: $page->title . ' - BizStateFiling')
@section('meta_description', $page->seo_description ?: '')
@section('meta_keywords', $page->seo_keywords ?: '')

@if ($page->canonical_url)
    @push('meta')
        <link rel="canonical" href="{{ $page->canonical_url }}">
    @endpush
@endif

@section('page_title', $page->title)

@if ($page->short_summary)
    @section('page_subtitle', $page->short_summary)
@endif

@section('content')

    <!-- Page Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                @if ($page->image)
                    <div class="mb-8">
                        <img src="{{ $page->image }}" alt="{{ $page->title }}" class="w-full h-auto rounded-lg shadow">
                    </div>
                @endif

                <div class="prose prose-lg max-w-none">
                    {!! $page->long_description !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('meta')
    @if ($page->canonical_url)
        <link rel="canonical" href="{{ $page->canonical_url }}">
    @endif
@endpush
