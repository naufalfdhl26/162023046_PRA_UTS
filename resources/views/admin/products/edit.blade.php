@extends('layouts.main')

@section('title', 'Edit Produk')

@section('content')
    <div class="grid gap-5 lg:grid-cols-[260px_1fr]">
        @include('partials.sidebar')

        <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100 sm:p-7">
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-[#ee4d2d]">Edit Produk</p>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">{{ $product->nama_produk }}</h1>
                    <p class="text-sm text-slate-500">Perbarui informasi produk tanpa mengubah alur CRUD.</p>
                </div>
                <a href="{{ route('seller.products.index') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-center text-sm font-bold text-slate-700 transition hover:border-[#ee4d2d] hover:text-[#ee4d2d]">Kembali</a>
            </div>

            <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @include('admin.products.partials.form')
                <button type="submit" class="w-full rounded-2xl bg-[#ee4d2d] px-5 py-3 text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325] sm:w-auto">Update Produk</button>
            </form>
        </div>
    </div>
@endsection
