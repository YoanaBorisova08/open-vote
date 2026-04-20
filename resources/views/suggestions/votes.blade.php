@php @endphp

<x-layout>
    <div class="flex flex-col gap-5 items-center justify-center w-4xl mx-auto py-10">
        <h1 class="text-center text-primary-dark text-3xl font-bold">My votes</h1>
        <p class="text-muted text-md mt-1">Suggestions you have voted on.</p>
    </div>

    <div class="grid grid-cols-2 gap-10 w-4xl mx-auto">
        @foreach($suggestions as $suggestion)
            <x-suggestions.card :suggestion="$suggestion"/>
        @endforeach
    </div>

    <div class="my-10 w-4xl mx-auto">
        {{ $suggestions->links() }}
    </div>
</x-layout>

