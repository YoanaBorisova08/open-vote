<x-layout>
    <div class="flex flex-col items-center justify-center gap-5 mt-10 w-4xl m-auto">

        <div class="flex flex-row justify-between w-full items-center px-5">
            <a href="{{ route('suggestions.index') }}"
               class="text-sm text-muted hover:text-primary">
                &larr; Back to all suggestions
            </a>
            @if(auth()->check() && auth()->user()->can('modify', $suggestion))
                <div class="flex flex-row gap-3 items-center">
                    <a href="{{ route('suggestions.edit', $suggestion) }}"
                       class="text-sm text-muted pt-0.5 text-center font-semibold hover:text-primary-dark">
                        Edit
                    </a>
                    <form method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-muted text-center font-semibold hover:text-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <x-suggestions.card :suggestion="$suggestion" class="w-4xl" :active="true" />

        @auth
            <div class="bg-surface-light w-2xs p-2 border
                border-border rounded-2xl text-center text-md text-muted
                cursor-pointer hover:bg-surface">
                <a href="{{route('suggestions.comment', $suggestion)}}">✚ Add a comment</a>
            </div>
        @endauth

        <div class="bg-surface-light w-full border border-border rounded-2xl p-5">
            <h2>Comments</h2>
            @forelse($suggestion->comments as $comment)
                <x-comment :comment="$comment" />
            @empty
                <p class="pt-4 text-sm text-muted">No comments yet.</p>
            @endforelse
        </div>
    </div>
</x-layout>
