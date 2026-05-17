@extends('layouts.main')

@section('title', 'UTS Shop - Marketplace')

@section('content')
    <section x-data="{ slide: 0, banners: ['Flash Sale Praktikum', 'Gratis Ongkir Spesial', 'Produk Terbaru Minggu Ini'] }" x-init="setInterval(() => slide = (slide + 1) % banners.length, 3500)" class="grid gap-4 lg:grid-cols-[1fr_320px]">
        <div class="relative min-h-64 overflow-hidden rounded-3xl bg-gradient-to-br from-[#ee4d2d] via-[#ff7337] to-[#ffb067] p-6 text-white shadow-lg sm:p-8">
            <div class="relative z-10 max-w-xl">
                <p class="inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-bold uppercase tracking-wide">Promo Marketplace</p>
                <h1 class="mt-5 text-3xl font-extrabold leading-tight sm:text-5xl" x-text="banners[slide]"></h1>
                <p class="mt-4 max-w-lg text-sm leading-6 text-white/90 sm:text-base">Temukan produk pilihan dengan pengalaman belanja yang cepat, bersih, dan responsive.</p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#produk" class="rounded-xl bg-white px-5 py-3 text-sm font-extrabold text-[#ee4d2d] shadow transition hover:-translate-y-1 hover:shadow-lg">Belanja Sekarang</a>
                    @auth
                        @if(auth()->user()->role === 'seller')
                            <a href="{{ route('seller.products.create') }}" class="rounded-xl bg-black/15 px-5 py-3 text-sm font-extrabold text-white ring-1 ring-white/30 transition hover:bg-black/25">Tambah Produk</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="absolute bottom-5 right-6 flex gap-2">
                <template x-for="(banner, index) in banners" :key="banner">
                    <button type="button" @click="slide = index" class="h-2.5 rounded-full transition-all" :class="slide === index ? 'w-8 bg-white' : 'w-2.5 bg-white/50'"></button>
                </template>
            </div>
            <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-14 right-24 h-40 w-40 rounded-full bg-white/10"></div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
            <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                <p class="text-xs font-bold uppercase tracking-wide text-[#ee4d2d]">Voucher</p>
                <h2 class="mt-2 text-xl font-extrabold text-slate-900">Diskon 25%</h2>
                <p class="mt-2 text-sm text-slate-500">Untuk produk pilihan selama promo tugas akhir.</p>
            </div>
            <div class="rounded-3xl bg-slate-900 p-5 text-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <p class="text-xs font-bold uppercase tracking-wide text-orange-200">Flash Sale</p>
                <h2 class="mt-2 text-xl font-extrabold">Mulai Hari Ini</h2>
                <p class="mt-2 text-sm text-white/70">Harga terbaik dengan tampilan katalog modern.</p>
            </div>
        </div>
    </section>

    <section class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-6">
        @foreach(['Elektronik', 'Fashion', 'Aksesoris', 'Rumah', 'Kampus', 'Promo'] as $category)
            <div class="rounded-2xl bg-white p-4 text-center text-sm font-bold text-slate-700 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:text-[#ee4d2d] hover:shadow-md">
                <div class="mx-auto mb-2 grid h-10 w-10 place-items-center rounded-full bg-orange-50 text-[#ee4d2d]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7.5 12 3 4 7.5m16 0-8 4.5m8-4.5v9L12 21m0-9L4 7.5m8 4.5v9M4 7.5v9L12 21" />
                    </svg>
                </div>
                {{ $category }}
            </div>
        @endforeach
    </section>

    <section id="produk" class="mt-8">
        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900">Rekomendasi Produk</h2>
                <p class="text-sm text-slate-500">
                    @if(!empty($search))
                        Hasil pencarian untuk "{{ $search }}"
                    @else
                        Produk terbaru yang tersedia di marketplace.
                    @endif
                </p>
            </div>
            <span class="rounded-full bg-orange-50 px-4 py-2 text-sm font-bold text-[#ee4d2d]">{{ $products->count() }} produk</span>
        </div>

        @if($products->isEmpty())
            <div class="rounded-3xl border border-dashed border-orange-200 bg-white p-12 text-center shadow-sm">
                <p class="text-lg font-bold text-slate-800">Produk belum ditemukan</p>
                <p class="mt-2 text-sm text-slate-500">Coba kata kunci lain atau tambahkan produk dari panel admin.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </section>
@endsection
