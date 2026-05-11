@extends('web.layouts.app')
@section('title', 'Finding Provider Partners')
@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 mx-auto mb-6">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Finding the Best Provider Match</h2>
                    <p class="text-gray-600 mb-8">We're analyzing your requirements to match you with the best business
                        formation partners...</p>

                    @if (!empty($matchedAffiliates))
                        <div class="text-left mt-8 border-t pt-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-6">Recommended Providers</h3>
                            <form method="POST" action="{{ route('formation.step6.post') }}">
                                @csrf
                                <div class="space-y-4">
                                    @foreach ($matchedAffiliates as $index => $affiliate)
                                        <div
                                            class="border rounded-lg p-4 hover:border-blue-400 transition-colors {{ $index === 0 ? 'border-blue-500 bg-blue-50' : '' }}">
                                            <label class="flex items-start space-x-3 cursor-pointer">
                                                <input type="radio" name="selected_affiliate_id"
                                                    value="{{ $affiliate['affiliate_id'] }}"
                                                    {{ $index === 0 ? 'checked' : '' }} class="h-5 w-5 text-blue-600 mt-1">
                                                <div class="flex-1">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <h4 class="font-semibold text-gray-800">{{ $affiliate['name'] }}
                                                            </h4>
                                                            @if ($affiliate['company'])
                                                                <p class="text-sm text-gray-500">{{ $affiliate['company'] }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">
                                                            Match Score: {{ $affiliate['score'] }}
                                                        </div>
                                                    </div>
                                                    @if ($affiliate['website'])
                                                        <p class="text-xs text-blue-600 mt-1">{{ $affiliate['website'] }}
                                                        </p>
                                                    @endif
                                                    <p class="text-xs text-gray-400 mt-1">Current load:
                                                        {{ $affiliate['current_load'] }}/{{ $affiliate['max_load'] }}</p>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 p-4 border rounded-lg bg-gray-50">
                                    <h4 class="font-semibold text-gray-700 mb-3">Routing Preference</h4>
                                    <select name="routing_method"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="single">Single Affiliate (route to selected only)</option>
                                        <option value="multi">Multi-Affiliate (route to all, primary selected)</option>
                                        <option value="weighted">Weighted Routing (score-based random selection)</option>
                                    </select>
                                </div>

                                <div class="mt-8 flex justify-between">
                                    <a href="{{ route('formation.step5') }}"
                                        class="text-gray-600 hover:text-gray-800 font-medium px-4 py-3">&larr; Back to
                                        Review</a>
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">Confirm
                                        & Route →</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="mt-8 p-6 bg-yellow-50 rounded-lg">
                            <p class="text-yellow-800">No specific provider matches found based on your criteria. We'll
                                route your lead to our general partner pool.</p>
                            <form method="POST" action="{{ route('formation.step6.post') }}" class="mt-4">
                                @csrf
                                <input type="hidden" name="routing_method" value="single">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">Continue
                                    →</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Auto-scroll to results after brief delay
            setTimeout(function() {
                window.scrollTo({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            }, 1500);
        </script>
    @endpush
@endsection
