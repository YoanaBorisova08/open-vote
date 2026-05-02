<?php
?>


<x-layout>
    <div class="flex flex-col items-center justify-center w-4xl gap-4 mx-auto">

        {{-- This handles the search option --}}
        <div class=" w-md self-end mt-10">
            <form method="GET" action="{{ route('suggestions.index') }}" class="flex items-center gap-2 justify-end">

                <div class="flex items-center border border-border rounded-lg overflow-hidden bg-surface-light">
                    <input type="text"
                           name="search"
                           placeholder="Search suggestions..."
                           class="w-3xs h-9 px-3 text-sm text-text bg-surface-light outline-none placeholder:text-muted"
                           value="{{ request('search') }}">

                    <button type="submit" class="h-9 px-3 text-muted hover:text-primary-dark transition-colors">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>

                    @if(request('search'))
                        <button type="submit" form="remove_search_form"
                                class="h-9 px-3 text-muted hover:text-primary border-l border-border transition-colors">
                            <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    @endif
                </div>

            </form>

            <form method="GET" action="{{ route('suggestions.index') }}" id="remove_search_form" class="hidden">
            </form>
        </div>

        @if($search)
            <div class="mt-10">
                <h2 class="text-3xl text-black block w-4xl border-t-2 border-black pt-4 mb-10">{{ $search_suggestions->total() }} {{Str::plural('result', $search_suggestions->total())}}
                    for "{{ $search }}"</h2>
                <x-suggestions.show_many :suggestions="$search_suggestions"
                                         format="grid grid-cols-2 gap-x-20 gap-y-8" width="w-full"
                                         :empty_message="false"/>

                <div class="mt-6">
                    {{ $search_suggestions->appends(['search' => $search])->links() }}
                </div>
            </div>
        @endif

        <div class="flex flex-row items-center justify-between w-full mt-15 mb-20">
            <x-suggestions.show_many title="Most popular" :suggestions="$popular_suggestions"/>
            <x-suggestions.show_many title="Most recent" :suggestions="$recent_suggestions"/>
        </div>
    </div>
</x-layout>
