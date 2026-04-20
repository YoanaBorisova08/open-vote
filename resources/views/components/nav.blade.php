<nav class="bg-primary-dark px-6 flex items-center justify-between h-16">
    <a href="{{ route('home') }}" class="flex items-center gap-2.5 no-underline">
        <svg width="36" height="36" viewBox="0 0 56 56">
            <rect width="56" height="56" rx="10" fill="#27500A"/>
            <rect x="8" y="8" width="40" height="8" rx="3" fill="#97C459"/>
            <rect x="8" y="22" width="28" height="8" rx="3" fill="#97C459"/>
            <rect x="8" y="36" width="18" height="8" rx="3" fill="#639922"/>
            <circle cx="42" cy="34" r="14" fill="#3B6D11"/>
            <polyline points="34,34 40,41 52,25" fill="none" stroke="#EAF3DE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="text-xl font-semibold text-primary-subtle tracking-tight">
            open<span class="text-primary-light">vote</span>
        </span>
    </a>

    <div class="flex items-center gap-1.5">
        <a href="{{ route('forum') }}" class="text-primary-hover text-sm px-3 py-1.5 rounded-md hover:bg-primary-dark">Forum</a>

        @guest
            <a href="{{route('login')}}" class="bg-text-on-primary text-primary-subtle text-sm font-medium px-4 py-1.5 rounded-md ml-2">Log in</a>
            <a href="{{route('register')}}" class="bg-primary-light text-text-on-primary text-sm font-medium px-4 py-1.5 rounded-md">Sign up</a>
        @endguest

        @auth
            <a href="{{ route('suggestions.create') }}" class="text-primary-hover text-sm px-3 py-1.5 rounded-md hover:bg-primary-dark">Suggest</a>
            <a href="{{ route('my-votes') }}" class="text-primary-hover text-sm px-3 py-1.5 rounded-md hover:bg-primary-dark">My votes</a>
            <a href="{{ route('profile') }}" class="text-primary-hover text-sm px-3">My profile</a>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="bg-text-on-primary text-primary-subtle text-sm font-medium px-4 py-1.5 rounded-md">Log out</button>
            </form>
        @endauth
    </div>
</nav>
