<div class="mb-8">
    <div class="flex items-center justify-between">
        @php $steps = [1 => 'Entity Type', 2 => 'State', 3 => 'Details', 4 => 'Specifics', 5 => 'Review']; @endphp
        @foreach ($steps as $num => $label)
            <div class="flex items-center">
                <div
                    class="w-8 h-8 {{ $num <= $current ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} rounded-full flex items-center justify-center text-sm font-bold">
                    {{ $num }}
                </div>
                <span
                    class="ml-2 text-sm font-medium {{ $num <= $current ? 'text-blue-600' : 'text-gray-400' }} hidden md:inline">{{ $label }}</span>
            </div>
            @if (!$loop->last)
                <div class="flex-1 mx-2 h-1 {{ $num < $current ? 'bg-blue-600' : 'bg-gray-300' }}"></div>
            @endif
        @endforeach
    </div>
</div>
