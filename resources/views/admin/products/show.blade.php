@extends('layouts.main')

@section('title', 'Detail Produk')

@section('content')
    <div class="grid gap-5 lg:grid-cols-[260px_1fr]">
        @include('partials.sidebar')

        <div class="space-y-5">
            <div class="flex flex-col gap-3 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-[#ee4d2d]">Detail Produk</p>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">{{ $product->nama_produk }}</h1>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('seller.products.edit', $product) }}" class="rounded-xl bg-amber-500 px-4 py-2 text-sm font-bold text-white transition hover:bg-amber-600">Edit</a>
                    <a href="{{ route('seller.products.index') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-[#ee4d2d] hover:text-[#ee4d2d]">Kembali</a>
                </div>
            </div>

            <div class="grid gap-5 lg:grid-cols-[420px_1fr]">
                <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
                    <div class="aspect-square bg-slate-100">
                        @if($product->gambar)
                            <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_produk }}" class="h-full w-full object-cover">
                        @else
                            <div class="grid h-full place-items-center text-sm font-bold text-slate-400">Tidak ada gambar</div>
                        @endif
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                    <p class="text-3xl font-extrabold text-[#ee4d2d]">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <h2 class="mt-4 text-2xl font-extrabold text-slate-900">{{ $product->nama_produk }}</h2>
                    <p class="mt-3 leading-7 text-slate-600">{{ $product->deskripsi ?: 'Belum ada deskripsi.' }}</p>

                    <dl class="mt-6 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-orange-50 p-4">
                            <dt class="text-sm font-bold text-slate-500">Stok</dt>
                            <dd class="mt-1 text-xl font-extrabold text-slate-900">{{ $product->stok }}</dd>
                        </div>
                        <div class="rounded-2xl bg-orange-50 p-4">
                            <dt class="text-sm font-bold text-slate-500">Dibuat</dt>
                            <dd class="mt-1 text-xl font-extrabold text-slate-900">{{ $product->created_at->format('d M Y') }}</dd>
                        </div>
                    </dl>

                    @if($product->categories->isNotEmpty())
                        <div class="mt-6 flex flex-wrap gap-2">
                            @foreach($product->categories as $category)
                                <span class="rounded-full bg-[#ee4d2d] px-3 py-1 text-xs font-bold text-white">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
