<x-form title="Create your account" subtitle="Join the community and make your voice heard">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <x-form.field name="name" label="Full name" placeholder="Your Name" />
                <x-form.field name="email" label="Email" placeholder="email@example.com" type="email" />
                <x-form.field name="password" label="Password" type="password" />

                <button type="submit" class="w-full h-11 bg-primary-dark text-primary-subtle rounded-lg text-sm font-medium mt-2 hover:bg-text-on-primary transition-colors">
                    Create account
                </button>
            </form>

            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-border"></div>
                <span class="text-xs text-muted">or</span>
                <div class="flex-1 h-px bg-border"></div>
            </div>

            <p class="text-center text-sm text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary-dark font-medium">Sign in</a></p>

</x-form>
