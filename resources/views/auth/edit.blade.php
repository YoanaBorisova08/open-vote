<x-form title="Edit your account">

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <x-form.field name="name" label="Full name" :value="$user->name" />
        <x-form.field name="email" label="Email" :value="$user->email" type="email" />
        <x-form.field name="password" label="Password" type="password" />

        <button type="submit" class="w-full h-11 bg-primary-dark text-primary-subtle rounded-lg text-sm font-medium mt-2 hover:bg-text-on-primary transition-colors">
            Edit account
        </button>
        <a class="text-center w-full block text-muted text-xs pt-2 hover:underline" href="{{route('profile')}}">Cancel</a>
    </form>

</x-form>
