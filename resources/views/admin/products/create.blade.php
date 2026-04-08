@extends('layouts.main')

@section('content')
    <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Tambah Produk</h1>
                <p class="mt-1 text-slate-500">Isi data produk baru dan pilih kategori yang tepat.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex rounded-xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Kembali ke Daftar Produk</a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Nama Produk</label>
                <input type="text" name="name" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white" />
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Harga</label>
                <input type="number" name="price" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white" />
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Pilih Kategori</label>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach($categories as $category)
                        <label class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-100">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500" />
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">Simpan Produk</button>
        </form>
    </div>
@endsection