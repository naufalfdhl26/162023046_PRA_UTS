@extends('layouts.main')

@section('title', $product->nama_produk)

@section('content')
    <div class="grid gap-5 lg:grid-cols-[480px_1fr]">
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
            <div class="aspect-square bg-slate-100">
                @if($product->gambar)
                    <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_produk }}" class="h-full w-full object-cover">
                @else
                    <div class="grid h-full place-items-center text-slate-400">Tidak ada gambar</div>
                @endif
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
            <p class="text-sm font-bold text-slate-500">Dijual oleh {{ $product->seller?->name ?? 'Seller' }}</p>
            <h1 class="mt-3 text-3xl font-extrabold text-slate-900">{{ $product->nama_produk }}</h1>
            <p class="mt-4 text-4xl font-extrabold text-[#ee4d2d]">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p class="mt-4 leading-7 text-slate-600">{{ $product->deskripsi ?: 'Belum ada deskripsi produk.' }}</p>
            <p class="mt-5 inline-flex rounded-full bg-orange-50 px-4 py-2 text-sm font-bold text-[#ee4d2d]">Stok {{ $product->stok }}</p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                @auth
                    @if(auth()->user()->role === 'buyer')
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                            @csrf
                            <button class="w-full rounded-2xl bg-[#ee4d2d] px-6 py-3 text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]">Tambah ke Cart</button>
                        </form>
                    @elseif(auth()->user()->role === 'seller' && auth()->id() === $product->seller_id)
                        <a href="{{ route('seller.products.edit', $product) }}" class="flex-1 rounded-2xl bg-[#ee4d2d] px-6 py-3 text-center text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]">Edit Produk</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex-1 rounded-2xl bg-[#ee4d2d] px-6 py-3 text-center text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]">Login untuk Beli</a>
                @endauth
                <a href="{{ route('products.index') }}" class="rounded-2xl border border-orange-200 px-6 py-3 text-center text-sm font-extrabold text-[#ee4d2d] transition hover:bg-orange-50">Kembali</a>
            </div>
        </div>
    </div>
@endsection
