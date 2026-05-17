@auth
    <aside class="overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm">
        <div class="bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] p-5 text-white">
            <div class="grid h-14 w-14 place-items-center rounded-full bg-white text-lg font-extrabold text-[#ee4d2d] shadow">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <p class="mt-3 truncate font-bold">{{ auth()->user()->name }}</p>
            <p class="text-xs text-white/80">{{ ucfirst(auth()->user()->role) }}</p>
        </div>
        <div class="space-y-1 p-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-700 transition hover:bg-orange-50 hover:text-[#ee4d2d]">
                <span class="h-2 w-2 rounded-full bg-[#ee4d2d]"></span> Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-700 transition hover:bg-orange-50 hover:text-[#ee4d2d]">
                <span class="h-2 w-2 rounded-full bg-[#ee4d2d]"></span> Profile
            </a>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-700 transition hover:bg-orange-50 hover:text-[#ee4d2d]">
                    <span class="h-2 w-2 rounded-full bg-[#ee4d2d]"></span> Kelola Produk
                </a>
            @else
                <a href="{{ route('cart.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-700 transition hover:bg-orange-50 hover:text-[#ee4d2d]">
                    <span class="h-2 w-2 rounded-full bg-[#ee4d2d]"></span> Cart
                </a>
            @endif
        </div>
    </aside>
@endauth
