@props(['suggestion', 'active' => false])

<a href="{{$active ? '' : route('suggestions.show', $suggestion)}}" class="block">
    <article {{ $attributes->merge(['class' => 'bg-surface-light border
        border-border rounded-2xl p-5 flex flex-col gap-3']) }}>

        <div class="flex items-start justify-between">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide {{ $suggestion->color() }}">
                                    {{ $suggestion->status->value }}
            </span>
            <div class="flex items-center gap-1.5 text-sm text-muted">
                <form method="POST" action="{{route('suggestions.vote', $suggestion) }}">
                    @csrf
                    <button type="submit" style="font-size:16px;">
                        {{ $suggestion->votes->contains('user_id', auth()->id()) ? '❤️' : '🤍' }}
                    </button>
                </form>
                <span class="font-medium text-text">{{ $suggestion->votes_count }}</span>
            </div>
        </div>

        <p class="{{ $active ? 'text-xl' : 'text-base'}} font-semibold text-green-900">{{ $suggestion->title }}</p>
        @if($active)
            <p class="text-md text-green-900 mb-3">{{ $suggestion->description }}</p>
        @endif


        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-primary-subtle flex items-center justify-center text-xs font-semibold text-text-on-primary">
                    {{ strtoupper(substr($suggestion->user->name, 0, 2)) }}
                </div>
                <span class="text-sm text-gray-600 font-medium">{{ $suggestion->user->name }}</span>
            </div>
            <span class="text-xs text-muted">{{ $suggestion->updated_at->diffForHumans() }}</span>
        </div>

    </article>
</a>
