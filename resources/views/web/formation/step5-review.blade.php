@extends('web.layouts.app')
@section('title', 'Step 5 - Review & Confirm')
@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                @include('web.formation._progress', ['current' => 5])
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Review Your Information</h2>
                    <p class="text-gray-600 mb-6">Please review your details before submitting. You can go back to any step
                        to make changes.</p>

                    <form method="POST" action="{{ route('formation.step5.post') }}">
                        @csrf
                        <div class="space-y-6">
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <h3 class="font-semibold text-gray-800 mb-3">Entity Type & State</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><span class="text-gray-500 text-sm">Entity Type:</span>
                                        <p class="font-medium">{{ $summary['entity_type_label'] }}</p>
                                    </div>
                                    <div><span class="text-gray-500 text-sm">State:</span>
                                        <p class="font-medium">{{ $summary['state'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded-lg p-4 bg-gray-50">
                                <h3 class="font-semibold text-gray-800 mb-3">Business Details</h3>
                                <div class="grid grid-cols-1 gap-3">
                                    <div><span class="text-gray-500 text-sm">Business Name:</span>
                                        <p class="font-medium">{{ $summary['business_name'] }}</p>
                                    </div>
                                    @if ($summary['business_address'])
                                        <div><span class="text-gray-500 text-sm">Address:</span>
                                            <p class="font-medium">{{ $summary['business_address'] }}</p>
                                        </div>
                                    @endif
                                    <div class="flex flex-wrap gap-4 mt-2">
                                        @if ($summary['needs_registered_agent'])
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Registered
                                                Agent</span>
                                        @endif
                                        @if ($summary['needs_ein'])
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">EIN
                                                Needed</span>
                                        @endif
                                        @if ($summary['needs_annual_report_assistance'])
                                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Annual
                                                Report Assistance</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if (!empty($summary['entity_specific']))
                                <div class="border rounded-lg p-4 bg-gray-50">
                                    <h3 class="font-semibold text-gray-800 mb-3">Entity-Specific Details</h3>
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($summary['entity_specific'] as $key => $value)
                                            @if ($value)
                                                <div>
                                                    <span
                                                        class="text-gray-500 text-sm">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                                    <p class="font-medium">
                                                        {{ is_bool($value) ? ($value ? 'Yes' : 'No') : $value }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <p class="text-gray-500 text-sm italic">By submitting, you agree to have your information shared
                                with our partner providers for business formation services.</p>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('formation.step4') }}"
                                class="text-gray-600 hover:text-gray-800 font-medium px-4 py-3">&larr; Back</a>
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">Submit
                                & Find Providers →</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
