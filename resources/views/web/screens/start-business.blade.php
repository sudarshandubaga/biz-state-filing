@extends('web.layouts.app')

@section('title', 'Start a Business - ' . getSetting('site_name'))

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Start a Business</h1>
            <p class="text-lg text-gray-600 mb-8">Everything you need to know about starting your business entity.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-lg mb-3">Complete Startup Guide</h3>
                    <p class="text-gray-600 text-sm">Step-by-step guide to launching your business.</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-lg mb-3">Choose a Business Structure</h3>
                    <p class="text-gray-600 text-sm">Compare LLC, C Corp, S Corp, and Sole Proprietorship.</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-lg mb-3">Startup Cost Calculator</h3>
                    <p class="text-gray-600 text-sm">Estimate your business startup costs.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
