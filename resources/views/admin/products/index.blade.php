@extends('layouts.main')

@section('title', 'Kelola Produk')

@section('content')
    <div class="grid gap-5 lg:grid-cols-[260px_1fr]">
        @include('partials.sidebar')

        <div class="space-y-5">
            <div class="flex flex-col gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-[#ee4d2d]">Admin Produk</p>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Kelola Produk</h1>
                    <p class="text-sm text-slate-500">Tambah, lihat detail, edit, dan hapus produk toko.</p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-xl bg-[#ee4d2d] px-5 py-3 text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]">Tambah Produk</a>
            </div>

            <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-orange-50 text-xs font-bold uppercase tracking-wide text-[#ee4d2d]">
                            <tr>
                                <th class="px-5 py-4">Gambar</th>
                                <th class="px-5 py-4">Produk</th>
                                <th class="px-5 py-4">Harga</th>
                                <th class="px-5 py-4">Stok</th>
                                <th class="px-5 py-4">Dibuat</th>
                                <th class="px-5 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($products as $product)
                                <tr class="transition hover:bg-orange-50/50">
                                    <td class="px-5 py-4">
                                        <div class="h-16 w-16 overflow-hidden rounded-2xl bg-slate-100">
                                            @if($product->gambar)
                                                <img src="{{ asset('storage/'.$product->gambar) }}" alt="{{ $product->nama_produk }}" class="h-full w-full object-cover">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-bold text-slate-900">{{ $product->nama_produk }}</p>
                                        <p class="max-w-xs truncate text-sm text-slate-500">{{ $product->deskripsi }}</p>
                                    </td>
                                    <td class="px-5 py-4 font-extrabold text-[#ee4d2d]">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="px-5 py-4 text-slate-600">{{ $product->stok }}</td>
                                    <td class="px-5 py-4 text-slate-500">{{ $product->created_at->format('d M Y') }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.products.show', $product) }}" class="rounded-xl border border-slate-200 px-3 py-2 text-xs font-bold text-slate-700 transition hover:border-[#ee4d2d] hover:text-[#ee4d2d]">Detail</a>
                                            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-xl bg-amber-500 px-3 py-2 text-xs font-bold text-white transition hover:bg-amber-600">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus produk ini?')" class="rounded-xl bg-rose-600 px-3 py-2 text-xs font-bold text-white transition hover:bg-rose-700">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-10 text-center text-slate-500">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ route('admin.products.create') }}" class="fixed bottom-6 right-6 grid h-14 w-14 place-items-center rounded-full bg-[#ee4d2d] text-3xl font-light text-white shadow-xl shadow-orange-950/20 transition hover:-translate-y-1 hover:bg-[#d94325]" aria-label="Tambah produk">+</a>
        </div>
    </div>
@endsection
