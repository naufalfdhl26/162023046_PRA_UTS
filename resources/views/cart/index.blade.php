@extends('layouts.main')

@section('title', 'Cart')

@section('content')
    <div class="mb-5 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-100">
        <p class="text-sm font-bold uppercase tracking-wide text-[#ee4d2d]">Keranjang</p>
        <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Isi Keranjang Anda</h1>
        <p class="text-sm text-slate-500">Review produk yang sudah ditambahkan.</p>
    </div>

    @if(count($cart) > 0)
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-orange-50 text-xs font-bold uppercase tracking-wide text-[#ee4d2d]">
                        <tr>
                            <th class="px-5 py-4">Produk</th>
                            <th class="px-5 py-4">Jumlah</th>
                            <th class="px-5 py-4">Harga</th>
                            <th class="px-5 py-4">Subtotal</th>
                            <th class="px-5 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $details)
                            @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                            <tr class="transition hover:bg-orange-50/50">
                                <td class="px-5 py-4 font-bold text-slate-900">{{ $details['name'] }}</td>
                                <td class="px-5 py-4 text-slate-600">{{ $details['quantity'] }}</td>
                                <td class="px-5 py-4 font-bold text-[#ee4d2d]">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td class="px-5 py-4 font-extrabold text-slate-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td class="px-5 py-4">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="rounded-xl bg-rose-600 px-3 py-2 text-xs font-bold text-white transition hover:bg-rose-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-slate-50">
                        <tr>
                            <td colspan="3" class="px-5 py-5 text-right font-bold text-slate-700">Total</td>
                            <td class="px-5 py-5 text-xl font-extrabold text-[#ee4d2d]">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td class="px-5 py-5"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="rounded-3xl border border-dashed border-orange-200 bg-white p-12 text-center shadow-sm">
            <p class="text-lg font-extrabold text-slate-900">Keranjang kosong</p>
            <p class="mt-2 text-sm text-slate-500">Belanja produk terlebih dahulu dari halaman katalog.</p>
            <a href="{{ route('home') }}" class="mt-5 inline-flex rounded-2xl bg-[#ee4d2d] px-5 py-3 text-sm font-extrabold text-white transition hover:bg-[#d94325]">Mulai Belanja</a>
        </div>
    @endif
@endsection
