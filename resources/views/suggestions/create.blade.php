<x-form title="Share your idea"
        subtitle="Got something in mind? Describe it clearly and the community will vote on it.">

    <form method="POST" action="{{ route('suggestions.store') }}">
        @csrf

        <x-form.field name="title" label="Title"
                      placeholder="A clear and concise title for your suggestion."
                      required/>
        <x-form.field type="textarea" name="description" label="Description"
                      placeholder="Describe your suggestion in detail. The more information you provide, the better!"
                      required />

        <div class="flex items-center justify-end gap-4 mt-6">
            <a href="{{ route('home') }}" class="text-sm text-muted hover:underline">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">Create!</button>
        </div>
    </form>
</x-form>
