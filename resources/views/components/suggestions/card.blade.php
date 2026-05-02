@php use App\Enums\SuggestionStatus; @endphp
@props(['suggestion', 'active' => false])

@if(!$active)
    <a href="{{ route('suggestions.show', $suggestion) }}" class="block">
@endif

    <article {{ $attributes->merge(['class' => 'bg-surface-light border border-border rounded-2xl p-5 flex flex-col gap-3']) }}>

        <div class="flex items-start justify-between">
            <div>
                @can('admin')
                    @if($active)
                        <form method="POST" action="{{ route('suggestions.status.update', $suggestion) }}" onclick="event.stopPropagation()">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center gap-2">
                                <select name="status"
                                        class="inline-flex items-center text-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide cursor-pointer {{ $suggestion->color() }}">
                                    @foreach(SuggestionStatus::cases() as $statusOption)
                                        <option value="{{ $statusOption->value }}"
                                            {{ $suggestion->status === $statusOption ? 'selected' : '' }}>
                                            {{ ucfirst($statusOption->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-xs text-muted hover:text-primary-dark">✓</button>
                            </div>
                        </form>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide {{ $suggestion->color() }}">
                        {{ $suggestion->status->value }}
                    </span>
                    @endif
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide {{ $suggestion->color() }}">
                    {{ $suggestion->status->value }}
                </span>
                @endcan
            </div>

            <div class="flex items-center gap-1.5 text-sm text-muted">
                <form method="POST" action="{{ route('suggestions.vote.store', $suggestion) }}" onclick="event.stopPropagation()">
                    @csrf
                    <button type="submit" style="font-size:16px;">
                        {{ $suggestion->votes->contains('user_id', auth()->id()) ? '❤️' : '🤍' }}
                    </button>
                </form>
                <span class="font-medium text-text">{{ $suggestion->votes_count }}</span>
            </div>
        </div>

        <p class="{{ $active ? 'text-xl' : 'text-base h-12' }} font-semibold text-green-900 line-clamp-2">{{ $suggestion->title }}</p>
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

@if(!$active)
    </a>
@endif
