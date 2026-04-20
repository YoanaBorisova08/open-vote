<x-form title="Edit your comment">
    <x-suggestions.card :suggestion="$comment->suggestion" class="w-90 my-5 self-center" :active="true" />
    <form method="POST" action="{{ route('suggestions.comment.update', $comment) }}">
        @csrf
        @method('PATCH')

        <x-form.field type="textarea" name="body"
                      value="{{ old('body', $comment->body) }}"
                      required />

        <div class="flex items-center justify-end gap-4 mt-6">
            <a href="{{ route('suggestions.show', $comment->suggestion) }}" class="text-sm text-muted hover:underline">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">Edit!</button>
        </div>
    </form>
</x-form>

