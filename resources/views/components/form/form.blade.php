@props(['title' => '', 'subtitle' => ''])

<x-layout>
    <div class="min-h-screen bg-surface flex items-center justify-center p-8">
        <div class="bg-surface-light rounded-2xl border border-border p-10 w-full max-w-md">

            <div class="flex items-center justify-center gap-2 mb-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2 no-underline">
                    <svg width="28" height="28" viewBox="0 0 56 56">
                        <rect width="56" height="56" rx="10" fill="#27500A"/>
                        <rect x="8" y="8" width="40" height="8" rx="3" fill="#97C459"/>
                        <rect x="8" y="22" width="28" height="8" rx="3" fill="#97C459"/>
                        <rect x="8" y="36" width="18" height="8" rx="3" fill="#639922"/>
                        <circle cx="42" cy="34" r="14" fill="#3B6D11"/>
                        <polyline points="34,34 40,41 52,25" fill="none" stroke="#EAF3DE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-xl font-semibold text-green-900 tracking-tight">open<span class="text-primary">vote</span></span>
                </a>
            </div>

            @if($title)
                <h1 class="text-lg font-medium text-center text-green-900 mb-1">{{ $title }}</h1>
            @endif
            @if($subtitle)
                <p class="text-sm text-muted text-center mb-6">{{ $subtitle }}</p>
            @endif

            {{ $slot }}

        </div>
    </div>
</x-layout>
