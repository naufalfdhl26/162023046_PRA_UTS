@extends('layouts.main')

@section('content')
    <div class="mb-8 rounded-2xl bg-slate-50 border border-slate-200 p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Panel Admin - Daftar Produk</h1>
                <p class="mt-1 text-slate-500">Kelola produk Anda dengan cepat: tambah, edit, atau hapus item sesuai kebutuhan.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('home') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-100">Kembali ke Home</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-700">Logout</button>
                </form>
                <a href="{{ route('admin.products.create') }}" class="rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-700">Tambah Produk Baru</a>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full border-collapse text-left">
            <thead class="bg-slate-100 text-slate-700">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wide">Nama Produk</th>
                    <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wide">Harga</th>
                    <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wide">Kategori</th>
                    <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr class="border-t border-slate-100 even:bg-slate-50">
                        <td class="px-6 py-4 align-top text-slate-800">{{ $p->name }}</td>
                        <td class="px-6 py-4 align-top text-slate-800">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 align-top text-slate-700">
                            @foreach($p->categories as $c)
                                <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">{{ $c->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 align-top">
                            <a href="{{ route('admin.products.edit', $p->id) }}" class="inline-flex items-center rounded-xl bg-amber-500 px-3 py-2 text-sm font-semibold text-white transition hover:bg-amber-600">Edit</a>
                            <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" class="inline-flex items-center rounded-xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-rose-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection