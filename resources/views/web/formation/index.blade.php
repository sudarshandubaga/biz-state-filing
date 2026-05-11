@extends('web.layouts.app')

@section('title', 'Start Your Business Formation')

@section('content')
    <section class="py-16 bg-gradient-to-br from-blue-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Start Your Business Formation</h1>
                <p class="text-xl text-gray-600 mb-8">Complete our simple step-by-step process to get your business formed
                    quickly and efficiently.</p>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="text-3xl font-bold text-blue-600 mb-2">1</div>
                        <h3 class="font-semibold text-gray-800">Tell Us About Your Business</h3>
                        <p class="text-sm text-gray-500 mt-1">Entity type, state, and details</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="text-3xl font-bold text-blue-600 mb-2">2</div>
                        <h3 class="font-semibold text-gray-800">Review & Confirm</h3>
                        <p class="text-sm text-gray-500 mt-1">Verify all information</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="text-3xl font-bold text-blue-600 mb-2">3</div>
                        <h3 class="font-semibold text-gray-800">Get Matched</h3>
                        <p class="text-sm text-gray-500 mt-1">We find the best provider</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="text-3xl font-bold text-blue-600 mb-2">4</div>
                        <h3 class="font-semibold text-gray-800">We Route Your Lead</h3>
                        <p class="text-sm text-gray-500 mt-1">Sent to your partner</p>
                    </div>
                </div>
                <a href="{{ route('formation.step1') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-lg text-lg transition-colors">
                    Start My LLC
                </a>
            </div>
        </div>
    </section>
@endsection
