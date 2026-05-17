@extends('layouts.main')

@section('title', 'Pesanan Saya')

@section('content')
    <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
        <h1 class="text-2xl font-extrabold text-slate-900">Pesanan Saya</h1>
        <div class="mt-5 space-y-4">
            @forelse($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="block rounded-2xl border border-slate-100 p-4 transition hover:border-orange-200 hover:bg-orange-50">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="font-extrabold text-slate-900">Order #{{ $order->id }}</p>
                            <p class="text-sm text-slate-500">{{ $order->created_at->format('d M Y H:i') }} - {{ $order->items->count() }} item</p>
                        </div>
                        <p class="text-xl font-extrabold text-[#ee4d2d]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </a>
            @empty
                <p class="py-8 text-center text-slate-500">Belum ada riwayat pembelian.</p>
            @endforelse
        </div>
    </div>
@endsection
