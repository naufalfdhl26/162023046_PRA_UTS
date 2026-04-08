@extends('layouts.main')

@section('content')
    <div class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Edit Produk</h1>
                <p class="mt-1 text-slate-500">Ubah informasi produk dan kategori jika diperlukan.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex rounded-xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Kembali ke Daftar Produk</a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white" />
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Harga</label>
                <input type="number" name="price" value="{{ $product->price }}" required class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white" />
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Pilih Kategori</label>
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach($categories as $category)
                        <label class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-100">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500" />
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-sky-700">Update Produk</button>
        </form>
    </div>
@endsection