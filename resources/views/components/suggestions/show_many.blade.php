@props([
    'suggestions',
    'title' => null,
    'empty_message' => true,
    'format' => 'flex flex-col items-left justify-center gap-8',
    'width' => 'max-w-xl'])

<div class="{{ $format }} {{ $width }}">
    @if($title)
        <h2 class="text-3xl text-black block w-full border-t-2 border-black pt-4">{{ $title }}</h2>
    @endif

    @forelse($suggestions as $suggestion)
        <x-suggestions.card :suggestion="$suggestion" />

    @empty

        @if($empty_message)
            <p class="text-gray-500 text-md m-auto">No suggestions yet. <span class="font-bold"><a href="#">Create a new one.</a></span></p>
        @endif

    @endforelse
</div>
