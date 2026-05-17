@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    @if(auth()->user()->role === 'seller')
        <div class="grid gap-5 lg:grid-cols-[260px_1fr]">
            @include('partials.sidebar')

            <div class="space-y-5">
                <div class="rounded-3xl bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] p-6 text-white shadow-lg">
                    <p class="text-sm font-bold uppercase tracking-wide text-white/80">Seller Center</p>
                    <h1 class="mt-2 text-3xl font-extrabold">Dashboard Seller</h1>
                    <p class="mt-2 text-sm text-white/85">Pantau produk milikmu, stok, dan aktivitas pesanan dari satu halaman.</p>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-sm font-bold text-slate-500">Total Produk</p>
                        <p class="mt-3 text-4xl font-extrabold text-[#ee4d2d]">{{ $totalProducts }}</p>
                    </div>
                    <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-sm font-bold text-slate-500">Total Stok</p>
                        <p class="mt-3 text-4xl font-extrabold text-[#ee4d2d]">{{ $totalStock }}</p>
                    </div>
                    <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-sm font-bold text-slate-500">Total Transaksi</p>
                        <p class="mt-3 text-4xl font-extrabold text-[#ee4d2d]">{{ $totalSales }}</p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
                    <div class="flex items-center justify-between border-b border-slate-100 p-5">
                        <div>
                            <h2 class="text-lg font-extrabold text-slate-900">Produk Terbaru</h2>
                            <p class="text-sm text-slate-500">Data terakhir yang masuk ke katalog.</p>
                        </div>
                        <a href="{{ route('seller.products.index') }}" class="rounded-xl border border-orange-200 px-4 py-2 text-sm font-bold text-[#ee4d2d] transition hover:bg-orange-50">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-orange-50 text-xs font-bold uppercase tracking-wide text-[#ee4d2d]">
                                <tr>
                                    <th class="px-5 py-3">Produk</th>
                                    <th class="px-5 py-3">Harga</th>
                                    <th class="px-5 py-3">Stok</th>
                                    <th class="px-5 py-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($latestProducts as $product)
                                    <tr class="transition hover:bg-orange-50/50">
                                        <td class="px-5 py-4 font-semibold text-slate-800">{{ $product->nama_produk }}</td>
                                        <td class="px-5 py-4 font-bold text-[#ee4d2d]">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                        <td class="px-5 py-4 text-slate-500">{{ $product->stok }}</td>
                                        <td class="px-5 py-4 text-slate-500">{{ $product->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-8 text-center text-slate-500">Belum ada produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('seller.products.create') }}" class="fixed bottom-6 right-6 grid h-14 w-14 place-items-center rounded-full bg-[#ee4d2d] text-3xl font-light text-white shadow-xl shadow-orange-950/20 transition hover:-translate-y-1 hover:bg-[#d94325]" aria-label="Tambah produk">+</a>
            </div>
        </div>
    @else
        <div class="grid gap-5 lg:grid-cols-[260px_1fr]">
            @include('partials.sidebar')

            <div class="space-y-6">
                <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
                    <div class="bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] p-6 text-white">
                        <p class="text-sm font-bold uppercase tracking-wide text-white/80">Dashboard Buyer</p>
                        <h1 class="mt-2 text-3xl font-extrabold">Selamat datang, {{ $user->name }}</h1>
                    </div>
                    <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center">
                        <div class="h-24 w-24 overflow-hidden rounded-full bg-orange-50 ring-4 ring-white shadow-md">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="grid h-full w-full place-items-center text-3xl font-extrabold text-[#ee4d2d]">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-xl font-extrabold text-slate-900">{{ $user->name }}</p>
                            <p class="text-sm text-slate-500">{{ $user->email }}</p>
                            <a href="{{ route('profile.edit') }}" class="mt-3 inline-flex rounded-xl bg-[#ee4d2d] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#d94325]">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <section>
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900">Produk Terbaru</h2>
                            <p class="text-sm text-slate-500">Pilihan terbaru untuk kamu.</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-sm font-bold text-[#ee4d2d]">Lihat Semua</a>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($products->take(6) as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </section>

                <section>
                    <h2 class="mb-4 text-xl font-extrabold text-slate-900">Rekomendasi Produk</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($products->skip(6)->take(6) as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    @endif
@endsection
