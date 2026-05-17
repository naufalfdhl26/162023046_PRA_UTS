<nav x-data="{ open: false, userMenu: false }" class="sticky top-0 z-50 bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] text-white shadow-lg shadow-orange-950/10">
    <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-6">
        <div class="flex min-h-16 flex-col gap-3 py-3 lg:min-h-20 lg:flex-row lg:items-center lg:gap-6">
            <div class="flex items-center justify-between gap-3">
                <a href="{{ route('home') }}" class="group flex items-center gap-2">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-white text-[#ee4d2d] shadow-md transition group-hover:scale-105">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5-9 4.5L3 7.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 12 9 4.5 9-4.5M3 16.5 12 21l9-4.5" />
                        </svg>
                    </span>
                    <span class="text-xl font-extrabold tracking-wide">UTS Shop</span>
                </a>

                <button type="button" @click="open = !open" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 text-white transition hover:bg-white/25 lg:hidden">
                    <span class="sr-only">Menu</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('home') }}" method="GET" class="relative flex-1">
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari produk impianmu di UTS Shop" class="h-11 w-full rounded-xl border-0 bg-white pl-4 pr-14 text-sm font-medium text-slate-800 shadow-inner outline-none ring-0 placeholder:text-slate-400 focus:ring-2 focus:ring-white/70">
                <button type="submit" class="absolute right-1 top-1 grid h-9 w-12 place-items-center rounded-lg bg-[#ee4d2d] text-white transition hover:bg-[#d94325]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                    </svg>
                </button>
            </form>

            <div class="hidden items-center gap-1 text-sm font-semibold lg:flex">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 transition hover:bg-white/15">Home</a>
                <a href="{{ auth()->check() ? route('products.index') : route('home') }}" class="rounded-lg px-3 py-2 transition hover:bg-white/15">Produk</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 transition hover:bg-white/15">Dashboard</a>
                    @if(auth()->user()->role === 'seller')
                        <a href="{{ route('seller.products.index') }}" class="rounded-lg px-3 py-2 transition hover:bg-white/15">Produk Saya</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="rounded-lg px-3 py-2 transition hover:bg-white/15">Pesanan</a>
                        <a href="{{ route('cart.index') }}" class="relative grid h-10 w-10 place-items-center rounded-lg transition hover:bg-white/15" aria-label="Cart">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.5l2.25 12.75A2.25 2.25 0 0 0 8.22 17.5h8.56a2.25 2.25 0 0 0 2.2-1.78L20.25 7.5H5.1" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21h.01M18 21h.01" />
                            </svg>
                        </a>
                    @endif

                    <div class="relative">
                        <button type="button" @click="userMenu = !userMenu" class="flex items-center gap-2 rounded-xl bg-white/15 px-3 py-2 transition hover:bg-white/25">
                            <span class="grid h-7 w-7 place-items-center rounded-full bg-white text-xs font-bold text-[#ee4d2d]">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            <span class="max-w-28 truncate">{{ auth()->user()->name }}</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>
                        <div x-show="userMenu" x-cloak @click.outside="userMenu = false" class="absolute right-0 mt-2 w-48 overflow-hidden rounded-xl bg-white py-2 text-slate-700 shadow-xl ring-1 ring-black/5">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm transition hover:bg-orange-50 hover:text-[#ee4d2d]">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm transition hover:bg-orange-50 hover:text-[#ee4d2d]">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg px-3 py-2 transition hover:bg-white/15">Login</a>
                    <a href="{{ route('register') }}" class="rounded-xl bg-white px-4 py-2 text-[#ee4d2d] shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">Register</a>
                @endauth
            </div>
        </div>

        <div x-show="open" x-cloak class="space-y-2 border-t border-white/20 pb-4 pt-3 lg:hidden">
            <a href="{{ route('home') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Home</a>
            <a href="{{ auth()->check() ? route('products.index') : route('home') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Produk</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Dashboard</a>
                @if(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.products.index') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Produk Saya</a>
                @else
                    <a href="{{ route('orders.index') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Pesanan Saya</a>
                    <a href="{{ route('cart.index') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Cart</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">{{ auth()->user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-xl px-3 py-2 text-left text-sm font-semibold hover:bg-white/15">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block rounded-xl px-3 py-2 text-sm font-semibold hover:bg-white/15">Login</a>
                <a href="{{ route('register') }}" class="block rounded-xl bg-white px-3 py-2 text-sm font-semibold text-[#ee4d2d]">Register</a>
            @endauth
        </div>
    </div>
</nav>
