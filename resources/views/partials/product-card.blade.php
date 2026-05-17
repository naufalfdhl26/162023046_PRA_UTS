<article class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-950/10">
    <a href="{{ auth()->check() && auth()->user()->role === 'seller' ? route('seller.products.show', $product) : route('products.show', $product) }}" class="block">
        <div class="relative aspect-square overflow-hidden bg-slate-100">
            @if($product->gambar)
                <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_produk }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
            @else
                <div class="flex h-full items-center justify-center bg-gradient-to-br from-orange-50 to-slate-100 text-sm font-semibold text-slate-400">No Image</div>
            @endif
            <span class="absolute left-3 top-3 rounded-full bg-[#ee4d2d] px-2.5 py-1 text-xs font-bold text-white shadow">Promo</span>
        </div>
    </a>
    <div class="space-y-3 p-4">
        <div>
            <h3 class="line-clamp-2 min-h-10 text-sm font-semibold leading-5 text-slate-800">{{ $product->nama_produk }}</h3>
            <p class="mt-1 line-clamp-1 text-xs text-slate-400">{{ $product->deskripsi ?: 'Produk pilihan marketplace.' }}</p>
        </div>
        <div class="flex items-end justify-between gap-2">
            <p class="text-lg font-extrabold text-[#ee4d2d]">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p class="rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-500">Stok {{ $product->stok }}</p>
        </div>
        <div class="flex gap-2">
            @auth
                @if(auth()->user()->role === 'seller')
                    <a href="{{ route('seller.products.show', $product) }}" class="flex-1 rounded-xl border border-orange-200 px-3 py-2 text-center text-xs font-bold text-[#ee4d2d] transition hover:bg-orange-50">Detail</a>
                    <a href="{{ route('seller.products.edit', $product) }}" class="rounded-xl bg-[#ee4d2d] px-3 py-2 text-xs font-bold text-white transition hover:bg-[#d94325]">Edit</a>
                @else
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full rounded-xl bg-[#ee4d2d] px-3 py-2 text-sm font-bold text-white transition hover:bg-[#d94325]">Tambah Cart</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="w-full rounded-xl bg-[#ee4d2d] px-3 py-2 text-center text-sm font-bold text-white transition hover:bg-[#d94325]">Login untuk Beli</a>
            @endauth
        </div>
    </div>
</article>
