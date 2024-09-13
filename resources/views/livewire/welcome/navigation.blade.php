<nav class="-mx-3 flex flex-1 justify-center gap-x-4">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="min-w-24 text-center border rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:ring-black hover:text-black/70 focus:outline-none focus-visible:ring-black"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="min-w-24 text-center border rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:ring-black hover:text-black/70 focus:outline-none focus-visible:ring-black"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="min-w-24 text-center border rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:ring-black hover:text-black/70 focus:outline-none focus-visible:ring-black"
            >
                Register
            </a>
        @endif
    @endauth
</nav>
