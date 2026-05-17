@extends('layouts.main')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Order #{{ $order->id }}</h1>
                <p class="text-sm text-slate-500">{{ $order->created_at->format('d M Y H:i') }} - {{ ucfirst($order->status) }}</p>
            </div>
            <p class="text-2xl font-extrabold text-[#ee4d2d]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="mt-6 divide-y divide-slate-100">
            @foreach($order->items as $item)
                <div class="flex flex-col gap-2 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-bold text-slate-900">{{ $item->product_name }}</p>
                        <p class="text-sm text-slate-500">Seller: {{ $item->seller?->name ?? '-' }} - {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-extrabold text-[#ee4d2d]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
