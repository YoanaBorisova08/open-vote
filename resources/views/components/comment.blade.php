@props(['comment'])

<div class="flex flex-col gap-2 border-b border-surface p-4 bg-surface-light">

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">

            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-sm font-bold">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>

            <div>
                <p class="text-sm font-semibold">{{ $comment->user->name }}</p>
                <p class="text-xs text-muted">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        </div>

        @if(auth()->id() === $comment->user_id)
            <div class="flex items-center gap-3">
                <a href="{{route('suggestions.comment.edit', $comment)}}" class="text-xs mt-0.5 text-muted hover:text-primary transition cursor-pointer">Edit</a>
                <form method="POST" action="{{ route('suggestions.comment.destroy', $comment) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs text-muted hover:text-red-500 transition">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </div>

    <p class="text-sm text-gray-700 leading-relaxed pl-10">{{ $comment->body }}</p>

</div>
