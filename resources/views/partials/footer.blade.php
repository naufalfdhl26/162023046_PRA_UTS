<footer class="mt-8 border-t-4 border-[#ee4d2d] bg-white">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:grid-cols-2 lg:grid-cols-4 lg:px-6">
        <div>
            <h3 class="text-lg font-extrabold text-[#ee4d2d]">UTS Shop</h3>
            <p class="mt-3 text-sm leading-6 text-slate-500">Marketplace sederhana untuk praktikum Sistem Informasi Berbasis Web dengan tampilan modern dan responsive.</p>
        </div>
        <div>
            <h4 class="font-bold text-slate-900">Menu</h4>
            <div class="mt-3 space-y-2 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="block hover:text-[#ee4d2d]">Home</a>
                <a href="{{ auth()->check() ? route('products.index') : route('home') }}" class="block hover:text-[#ee4d2d]">Produk</a>
                @auth <a href="{{ route('dashboard') }}" class="block hover:text-[#ee4d2d]">Dashboard</a> @endauth
            </div>
        </div>
        <div>
            <h4 class="font-bold text-slate-900">Kontak</h4>
            <div class="mt-3 space-y-2 text-sm text-slate-500">
                <p>Email: support@utsshop.test</p>
                <p>Telepon: 0812-0000-0000</p>
                <p>Indonesia</p>
            </div>
        </div>
        <div>
            <h4 class="font-bold text-slate-900">Social</h4>
            <div class="mt-4 flex gap-3">
                @foreach(['f', 'ig', 'x'] as $social)
                    <span class="grid h-10 w-10 place-items-center rounded-full bg-orange-50 text-sm font-bold text-[#ee4d2d] transition hover:-translate-y-1 hover:bg-[#ee4d2d] hover:text-white">{{ $social }}</span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="border-t border-slate-100 py-4 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} UTS Shop. All rights reserved.
    </div>
</footer>
