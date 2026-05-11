@extends('web.layouts.app')
@section('title', 'Lead Sent Successfully')
@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Lead Sent Successfully!</h2>
                    <p class="text-lg text-gray-600 mb-8">Your business formation request has been sent to our partner
                        provider. They will contact you shortly.</p>

                    <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                        <h3 class="font-semibold text-gray-800 mb-4">What Happens Next?</h3>
                        <ol class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start space-x-3">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                                <span>A partnered business formation specialist will review your request</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                                <span>They will contact you via email or phone to discuss your needs</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                                <span>You'll receive a customized quote and timeline for your business formation</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-xs font-bold">4</span>
                                <span>Once approved, they'll handle the filing and formation process</span>
                            </li>
                        </ol>
                    </div>

                    @if ($lead->routedAffiliate)
                        <div class="border rounded-lg p-6 mb-8 text-left">
                            <h3 class="font-semibold text-gray-800 mb-3">Routed To</h3>
                            <p class="text-gray-700"><strong>{{ $lead->routedAffiliate->name }}</strong></p>
                            @if ($lead->routedAffiliate->email)
                                <p class="text-sm text-gray-500">{{ $lead->routedAffiliate->email }}</p>
                            @endif
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('formation.start') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                            Start Another Business
                        </a>
                        <a href="{{ route('home') }}"
                            class="border border-gray-300 hover:border-gray-400 text-gray-700 font-semibold px-8 py-3 rounded-lg transition-colors">
                            Return to Home
                        </a>
                    </div>

                    <p class="text-xs text-gray-400 mt-8">
                        Your reference ID: #{{ $lead->id }} &middot; Submitted:
                        {{ $lead->created_at->format('M d, Y g:i A') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
