<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-slate-900">Register</h1>
        <p class="mt-1 text-sm text-slate-500">Buat akun baru untuk belanja.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ role: '{{ old('role', 'buyer') }}' }" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-2 block text-sm font-bold text-slate-700">Nama</label>
            <input id="name" class="market-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama lengkap">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email</label>
            <input id="email" class="market-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="email@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="mb-2 block text-sm font-bold text-slate-700">Daftar sebagai</label>
            <div class="grid grid-cols-2 gap-3">
                <label class="cursor-pointer rounded-2xl border p-4 text-center text-sm font-extrabold transition" :class="role === 'buyer' ? 'border-[#ee4d2d] bg-orange-50 text-[#ee4d2d] ring-4 ring-orange-100' : 'border-slate-200 bg-white text-slate-700 hover:border-orange-200 hover:bg-orange-50 hover:text-[#ee4d2d]'">
                    <input type="radio" name="role" value="buyer" class="sr-only" x-model="role">
                    <span class="mx-auto mb-2 grid h-9 w-9 place-items-center rounded-full" :class="role === 'buyer' ? 'bg-[#ee4d2d] text-white' : 'bg-slate-100 text-slate-500'">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                        </svg>
                    </span>
                    Buyer
                </label>
                <label class="cursor-pointer rounded-2xl border p-4 text-center text-sm font-extrabold transition" :class="role === 'seller' ? 'border-[#ee4d2d] bg-orange-50 text-[#ee4d2d] ring-4 ring-orange-100' : 'border-slate-200 bg-white text-slate-700 hover:border-orange-200 hover:bg-orange-50 hover:text-[#ee4d2d]'">
                    <input type="radio" name="role" value="seller" class="sr-only" x-model="role">
                    <span class="mx-auto mb-2 grid h-9 w-9 place-items-center rounded-full" :class="role === 'seller' ? 'bg-[#ee4d2d] text-white' : 'bg-slate-100 text-slate-500'">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5A1.5 1.5 0 0 1 15 12h3a1.5 1.5 0 0 1 1.5 1.5V21M3 21h18M4.5 21V8.25A2.25 2.25 0 0 1 6.75 6h10.5a2.25 2.25 0 0 1 2.25 2.25V21M9 9.75h1.5M9 13.5h1.5M9 17.25h1.5" />
                        </svg>
                    </span>
                    Seller
                </label>
            </div>
            <p class="mt-2 text-xs font-medium text-slate-500">Role terpilih: <span class="font-extrabold text-[#ee4d2d]" x-text="role === 'seller' ? 'Seller' : 'Buyer'"></span></p>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Password</label>
            <input id="password" class="market-input" type="password" name="password" required autocomplete="new-password" placeholder="Password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">Konfirmasi Password</label>
            <input id="password_confirmation" class="market-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="">
            <div class="mb-4 flex justify-center">
                {!! NoCaptcha::display() !!}
            </div>
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2 text-center" />
            {!! NoCaptcha::renderJs() !!}
        </div>

        <button type="submit" class="w-full rounded-2xl bg-[#ee4d2d] px-5 py-3 text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]">Register</button>

        <p class="text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-[#ee4d2d]">Login</a>
        </p>
    </form>
</x-guest-layout>
