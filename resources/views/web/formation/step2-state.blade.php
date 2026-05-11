@extends('web.layouts.app')
@section('title', 'Step 2 - Select State')
@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                @include('web.formation._progress', ['current' => 2])
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Select State of Formation</h2>
                    <p class="text-gray-600 mb-6">Choose the state where you want to form your business entity.</p>
                    <form method="POST" action="{{ route('formation.step2.post') }}">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">State</label>
                            <select name="state_id" required
                                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('state_id') border-red-500 @enderror">
                                <option value="">-- Select a State --</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('state_id', session('formation.state_id')) == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('formation.step1') }}"
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
