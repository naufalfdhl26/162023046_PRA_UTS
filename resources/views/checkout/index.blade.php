@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
    @php $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']); @endphp

    <div class="grid gap-5 lg:grid-cols-[1fr_360px]">
        <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            <h1 class="text-2xl font-extrabold text-slate-900">Checkout</h1>
            <p class="mt-1 text-sm text-slate-500">Pastikan produk dan jumlah sudah benar.</p>

            <div class="mt-5 divide-y divide-slate-100">
                @forelse($cart as $item)
                    <div class="flex gap-4 py-4">
                        <div class="h-20 w-20 overflow-hidden rounded-2xl bg-slate-100">
                            @if($item['image'])
                                <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-slate-900">{{ $item['name'] }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <p class="font-extrabold text-[#ee4d2d]">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                @empty
                    <p class="py-8 text-center text-slate-500">Keranjang kosong.</p>
                @endforelse
            </div>
        </div>

        <div class="h-max rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
            <h2 class="text-lg font-extrabold text-slate-900">Ringkasan Belanja</h2>
            <div class="mt-5 flex items-center justify-between text-sm text-slate-500">
                <span>Total Harga</span>
                <span class="text-2xl font-extrabold text-[#ee4d2d]">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
                @csrf
                <button class="w-full rounded-2xl bg-[#ee4d2d] px-5 py-3 text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]" @disabled(count($cart) === 0)>Checkout Sekarang</button>
            </form>
        </div>
    </div>
@endsection
