@extends('web.layouts.app')
@section('title', 'Step 3 - Business Details')
@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                @include('web.formation._progress', ['current' => 3])
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Business Details</h2>
                    <p class="text-gray-600 mb-6">Tell us about your business so we can match you with the right provider.
                    </p>
                    <form method="POST" action="{{ route('formation.step3.post') }}">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Business Name *</label>
                                <input type="text" name="business_name"
                                    value="{{ old('business_name', session('formation.business_name')) }}" required
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 @error('business_name') border-red-500 @enderror">
                                @error('business_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="name_available" value="1"
                                        {{ old('name_available', session('formation.name_available')) ? 'checked' : '' }}
                                        class="h-5 w-5 text-blue-600 rounded">
                                    <span class="text-gray-700">I have checked that the business name is available</span>
                                </label>
                            </div>
                            <div>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="needs_registered_agent" value="1"
                                        {{ old('needs_registered_agent', session('formation.needs_registered_agent')) ? 'checked' : '' }}
                                        class="h-5 w-5 text-blue-600 rounded">
                                    <span class="text-gray-700">I need a Registered Agent service</span>
                                </label>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Business Address</label>
                                <textarea name="business_address" rows="2"
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('business_address', session('formation.business_address')) }}</textarea>
                            </div>
                            <div>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="needs_ein" value="1"
                                        {{ old('needs_ein', session('formation.needs_ein')) ? 'checked' : '' }}
                                        class="h-5 w-5 text-blue-600 rounded">
                                    <span class="text-gray-700">I need an EIN (Employer Identification Number)</span>
                                </label>
                            </div>
                            <div>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="needs_annual_report_assistance" value="1"
                                        {{ old('needs_annual_report_assistance', session('formation.needs_annual_report_assistance')) ? 'checked' : '' }}
                                        class="h-5 w-5 text-blue-600 rounded">
                                    <span class="text-gray-700">I need Annual Report assistance</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('formation.step2') }}"
                                class="text-gray-600 hover:text-gray-800 font-medium px-4 py-3">&larr; Back</a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">Continue
                                →</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
