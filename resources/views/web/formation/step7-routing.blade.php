@extends('web.layouts.app')
@section('title', 'Routing Your Lead')
@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 mx-auto mb-6">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Routing Your Lead</h2>
                    <p class="text-gray-600 mb-4">We are now routing your business formation request to the best provider
                        partner...</p>

                    <form method="POST" action="{{ route('formation.step7.post') }}">
                        @csrf
                        <div class="bg-blue-50 rounded-lg p-6 mb-6 text-left">
                            <h3 class="font-semibold text-gray-800 mb-3">Routing Summary</h3>
                            <div class="text-sm text-gray-600 space-y-2">
                                <p><strong>Business:</strong> {{ $lead->business_name }}</p>
                                <p><strong>Entity Type:</strong> {{ $lead->entity_type }}</p>
                                <p><strong>Selected Provider ID:</strong> #{{ $selectedAffiliateId ?? 'Auto-assign' }}</p>
                                <p><strong>Routing Method:</strong> {{ session('formation.routing_method', 'single') }}</p>
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                            Route My Lead →
                        </button>
                    </form>

                    <a href="{{ route('formation.step6') }}"
                        class="inline-block mt-4 text-gray-500 hover:text-gray-700 text-sm">&larr; Back to Provider
                        Selection</a>
                </div>
            </div>
        </div>
    </section>
@endsection
