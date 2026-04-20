<x-layout>
    <div class="bg-surface-light w-4xl mx-auto my-10 p-10 rounded-lg shadow">

        <h1 class="text-3xl text-center font-bold mb-10">My Profile</h1>

        <div class="flex items-center justify-between gap-5 bg-surface p-6 rounded-lg border border-border">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center text-white text-2xl font-bold shadow">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="flex flex-col gap-1">
                    <p class="text-xl font-semibold">{{ $user->name }}</p>
                    <p class="text-sm text-muted">{{ $user->email }}</p>
                    <p class="text-sm text-muted">Password: ••••••••</p>
                </div>
            </div>

            <div class="flex flex-col items-end gap-2">
                <a href="{{ route('profile.edit') }}" class="text-sm text-primary hover:underline transition">
                     Edit Profile
                </a>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-muted hover:text-red-500 transition">
                        Delete Account
                    </button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-muted hover:text-red-500 transition">
                        ➜ Log out
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-10 border-t border-border pt-6">
            <h2 class="text-2xl font-semibold mb-5">My Suggestions</h2>

            @forelse($user->suggestions as $suggestion)
                <div class="flex items-center justify-between bg-surface p-4 rounded-lg border border-border mb-3 hover:shadow transition">
                    <div>
                        <a href="{{ route('suggestions.show', $suggestion) }}" class="font-medium hover:text-primary transition">
                            {{ $suggestion->title }}
                        </a>
                        <p class="text-xs text-muted mt-1">{{ $suggestion->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('suggestions.edit', $suggestion) }}"
                           class="text-sm pt-0.5 text-primary hover:underline transition">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('suggestions.destroy', $suggestion) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm text-muted hover:text-red-500 transition"
                                    onclick="return confirm('Are you sure you want to delete this suggestion?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-muted text-sm text-center py-5">You have no suggestions yet.</p>
            @endforelse
        </div>

    </div>
</x-layout>
