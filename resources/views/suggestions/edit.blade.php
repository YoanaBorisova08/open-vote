<x-form title="Edit your idea">

    <form method="POST" action="{{ route('suggestions.update', $suggestion) }}">
        @csrf
        @method('PATCH')

        <x-form.field name="title" label="Title"
                      value="{{ $suggestion->title }}"
                      required />
        <x-form.field type="textarea" name="description" label="Description"
                      value="{{ $suggestion->description }}"
                      required />

        <div class="flex items-center justify-end gap-4 mt-6">
            <a href="{{ route('suggestions.show', $suggestion) }}" class="text-sm text-muted hover:underline">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">Edit!</button>
        </div>
    </form>
</x-form>
