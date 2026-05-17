<div x-data="{ preview: '{{ isset($product) && $product->gambar ? asset('storage/'.$product->gambar) : '' }}' }" class="grid gap-6 lg:grid-cols-[1fr_320px]">
    <div class="space-y-5">
        <div>
            <label for="nama_produk" class="mb-2 block text-sm font-bold text-slate-700">Nama Produk</label>
            <input id="nama_produk" type="text" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk ?? '') }}" required class="market-input" placeholder="Contoh: Sepatu Sneakers Premium">
            @error('nama_produk') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="deskripsi" class="mb-2 block text-sm font-bold text-slate-700">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="5" class="market-input" placeholder="Tulis deskripsi produk secara singkat dan jelas">{{ old('deskripsi', $product->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="harga" class="mb-2 block text-sm font-bold text-slate-700">Harga</label>
                <input id="harga" type="number" name="harga" value="{{ old('harga', $product->harga ?? '') }}" min="0" required class="market-input" placeholder="0">
                @error('harga') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="stok" class="mb-2 block text-sm font-bold text-slate-700">Stok</label>
                <input id="stok" type="number" name="stok" value="{{ old('stok', $product->stok ?? 0) }}" min="0" required class="market-input" placeholder="0">
                @error('stok') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        @if(isset($categories) && $categories->isNotEmpty())
            <div>
                <label class="mb-2 block text-sm font-bold text-slate-700">Kategori</label>
                <div class="grid gap-3 md:grid-cols-2">
                    @foreach($categories as $category)
                        <label class="flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 p-4 text-sm font-semibold text-slate-700 transition hover:border-orange-200 hover:bg-orange-50">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" @checked(collect(old('categories', isset($product) ? $product->categories->pluck('id')->all() : []))->contains($category->id)) class="rounded border-slate-300 text-[#ee4d2d] focus:ring-[#ee4d2d]">
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="rounded-3xl border border-dashed border-orange-200 bg-orange-50/60 p-4">
        <label for="gambar" class="mb-3 block text-sm font-bold text-slate-700">Gambar Produk</label>
        <div class="aspect-square overflow-hidden rounded-2xl bg-white shadow-inner">
            <template x-if="preview">
                <img :src="preview" alt="Preview gambar produk" class="h-full w-full object-cover">
            </template>
            <div x-show="!preview" class="flex h-full flex-col items-center justify-center p-6 text-center text-sm font-semibold text-slate-400">
                <svg class="mb-3 h-10 w-10 text-[#ee4d2d]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5V19a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2.5M16 8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Upload gambar produk
            </div>
        </div>
        <input id="gambar" type="file" name="gambar" accept="image/*" @change="preview = URL.createObjectURL($event.target.files[0])" class="mt-4 block w-full rounded-2xl border border-orange-200 bg-white text-sm text-slate-700 file:mr-4 file:border-0 file:bg-[#ee4d2d] file:px-4 file:py-3 file:text-sm file:font-bold file:text-white">
        @error('gambar') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
        <p class="mt-3 text-xs text-slate-500">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
    </div>
</div>
