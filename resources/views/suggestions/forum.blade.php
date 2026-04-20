@php use App\Enums\SuggestionStatus; @endphp

<x-layout>
    <div class="flex flex-col gap-5 items-center justify-center w-4xl mx-auto py-10">
        <h1 class="text-center text-primary-dark text-2xl font-bold">Vote. Suggest. Influence.</h1>
        <p class="text-muted text-sm mt-1">Got an idea? <a href="{{ route('suggestions.create') }}"
                                                           class="text-primary-dark font-medium hover:underline">Submit
                a suggestion →</a></p>
    </div>

    <div class="text-muted text-sm">
        <form method="GET" action="{{ route('forum') }}"
              class="flex flex-row items-center justify-between w-4xl mx-auto">

            <div class="flex items-center gap-3">

                <div class="flex items-center gap-2">
                    <label for="sort" class="text-sm text-muted whitespace-nowrap">Order by</label>
                    <select id="sort" name="sort"
                            onchange="this.form.submit()"
                            class="h-9 px-3 text-sm text-text bg-surface-light border border-border rounded-lg outline-none hover:border-primary cursor-pointer">
                        <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest
                        </option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="most_voted" {{ request('sort') === 'most_voted' ? 'selected' : '' }}>Most voted
                        </option>
                        <option value="least_voted" {{ request('sort') === 'least_voted' ? 'selected' : '' }}>Least
                            voted
                        </option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label for="status" class="text-sm text-muted whitespace-nowrap">Filter by</label>
                    <select id="status" name="status"
                            onchange="this.form.submit()"
                            class="h-9 px-3 text-sm text-text bg-surface-light border border-border rounded-lg outline-none hover:border-primary cursor-pointer">
                        <option value="" {{ request('status') === '' ? 'selected' : '' }}>All</option>
                        @foreach(SuggestionStatus::cases() as $statusOption)
                            <option
                                value="{{ $statusOption->value }}" {{ request('status') === $statusOption->value ? 'selected' : '' }}>
                                {{ ucfirst($statusOption->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

        </form>
    </div>

    <div class="grid grid-cols-2 gap-10 w-4xl mx-auto mt-10">
        @foreach($suggestions as $suggestion)
            <x-suggestions.card :suggestion="$suggestion"/>
        @endforeach
    </div>

    <div class="my-10 w-4xl mx-auto">
        {{ $suggestions->appends(['sort' => $sort, 'status' => $status])->links() }}
    </div>
</x-layout>
