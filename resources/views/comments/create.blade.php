<x-form title="Add a Comment"
        subtitle="Your opinion matters — feel free to share it">
    <x-suggestions.card :suggestion="$suggestion" class="w-90 mb-5 self-center" :active="true" />
    <form method="POST" action="{{ route('suggestions.comment.store', $suggestion) }}">
        @csrf

        <x-form.field type="textarea" name="body"
                      placeholder="Add a comment..."
                      required />

        <div class="flex items-center justify-end gap-4 mt-6">
            <a href="{{  route('suggestions.show', $suggestion) }}" class="text-sm text-muted hover:underline">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">Create!</button>
        </div>
    </form>
</x-form>

