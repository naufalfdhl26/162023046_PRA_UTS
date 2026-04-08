@extends('layouts.main')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Katalog Produk</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mb-4">
                        Kategori:
                        @foreach($product->categories as $category)
                            {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection