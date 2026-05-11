@extends('web.layouts.app')

@section('title', 'Step 1 - Select Entity Type')

@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                1</div>
                            <span class="ml-2 text-sm font-medium text-blue-600">Entity Type</span>
                        </div>
                        <div class="flex-1 mx-4 h-1 bg-gray-300"></div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                                2</div>
                            <span class="ml-2 text-sm font-medium text-gray-400">State</span>
                        </div>
                        <div class="flex-1 mx-4 h-1 bg-gray-300"></div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                                3</div>
                            <span class="ml-2 text-sm font-medium text-gray-400">Details</span>
                        </div>
                        <div class="flex-1 mx-4 h-1 bg-gray-300"></div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                                4</div>
                            <span class="ml-2 text-sm font-medium text-gray-400">Specifics</span>
                        </div>
                        <div class="flex-1 mx-4 h-1 bg-gray-300"></div>
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">
                                5</div>
                            <span class="ml-2 text-sm font-medium text-gray-400">Review</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Select Your Entity Type</h2>
                    <p class="text-gray-600 mb-6">Choose the business structure that best fits your needs.</p>

                    <form method="POST" action="{{ route('formation.step1.post') }}">
                        @csrf
                        <div class="space-y-4">
                            @foreach ($entityTypes as $key => $label)
                                <label
                                    class="block border rounded-lg p-4 hover:border-blue-400 cursor-pointer transition-colors @error('entity_type') border-red-500 @enderror">
                                    <div class="flex items-center">
                                        <input type="radio" name="entity_type" value="{{ $key }}"
                                            class="h-4 w-4 text-blue-600"
                                            {{ old('entity_type', session('formation.entity_type')) == $key ? 'checked' : '' }}
                                            required>
                                        <span class="ml-3 text-gray-700 font-medium">{{ $label }}</span>
                                    </div>
                                </label>
                            @endforeach
                            @error('entity_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                                Continue →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
