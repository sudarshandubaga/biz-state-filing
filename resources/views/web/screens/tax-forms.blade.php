@extends('web.layouts.app')
@section('title', 'Tax Forms – StateFilingDeadlines')
@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Tax & Business Forms</h1>
                <p class="text-gray-600 mb-8">Browse downloadable state and federal business forms for LLCs, corporations,
                    and compliance.</p>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm p-4 sticky top-24">
                            <h3 class="font-semibold text-gray-800 mb-3">Filter Forms</h3>
                            <div class="space-y-3">
                                <div><label class="block text-sm text-gray-600 mb-1">State</label>
                                    <select onchange="window.location=this.value"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                        <option value="{{ route('web.tax-forms') }}">All States</option>
                                        @foreach ($states as $s)
                                            <option value="{{ route('web.tax-forms.filter', $s->state_slug) }}"
                                                {{ $stateSlug == $s->state_slug ? 'selected' : '' }}>{{ $s->state_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div><label class="block text-sm text-gray-600 mb-1">Entity Type</label>
                                    <select
                                        onchange="window.location=this.value=='all'?'{{ route('web.tax-forms') }}':'{{ url('tax-forms') }}/'+(this.value=='all'?'':this.value)"
                                        class="w-full border rounded px-3 py-2 text-sm">
                                        <option value="all">All Types</option>
                                        @foreach (['llc' => 'LLC', 's-corporation' => 'S-Corp', 'c-corporation' => 'C-Corp', 'partnership' => 'Partnership', 'sole-proprietorship' => 'Sole Prop'] as $k => $v)
                                            <option value="{{ $k }}" {{ $entityType == $k ? 'selected' : '' }}>
                                                {{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        @if ($forms->count())
                            @foreach ($forms->groupBy('category') as $category => $catForms)
                                <div class="mb-8">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 capitalize">{{ $category }} Forms
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach ($catForms as $form)
                                            <div
                                                class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center hover:shadow-md transition">
                                                <div>
                                                    <h4 class="font-semibold text-gray-800">{{ $form->form_name }}</h4>
                                                    <p class="text-sm text-gray-500">
                                                        @if ($form->form_number)
                                                            <span class="font-mono">{{ $form->form_number }}</span> ·
                                                            @endif{{ $form->state->state_name ?? 'Federal' }}@if ($form->entity_type && $form->entity_type !== 'all')
                                                                · {{ ucwords(str_replace('-', ' ', $form->entity_type)) }}
                                                            @endif
                                                    </p>
                                                    @if ($form->description)
                                                        <p class="text-xs text-gray-400 mt-1">{{ $form->description }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    @if ($form->download_url)
                                                        <a href="{{ $form->download_url }}" target="_blank"
                                                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded transition-colors">Download</a>
                                                    @endif
                                                    @if ($form->official_url)
                                                        <a href="{{ $form->official_url }}" target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-sm border border-blue-600 px-3 py-2 rounded">Official</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                                <p class="text-gray-500">No forms found for the selected criteria.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
