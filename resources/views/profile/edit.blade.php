@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <div class="grid gap-5 lg:grid-cols-[260px_1fr]">
        @include('partials.sidebar')

        <div class="space-y-5">
            <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-100">
                <div class="bg-gradient-to-r from-[#ee4d2d] to-[#ff7337] p-6 text-white">
                    <p class="text-sm font-bold uppercase tracking-wide text-white/80">Akun Saya</p>
                    <h1 class="mt-2 text-3xl font-extrabold">Profile User</h1>
                    <p class="mt-2 text-sm text-white/85">Kelola identitas, email, password, dan foto profile.</p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" x-data="{ preview: '{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : '' }}' }" class="grid gap-6 p-6 lg:grid-cols-[260px_1fr]">
                    @csrf
                    @method('PATCH')

                    <div class="text-center">
                        <div class="mx-auto h-36 w-36 overflow-hidden rounded-full bg-orange-50 ring-4 ring-orange-100 shadow-md">
                            <template x-if="preview">
                                <img :src="preview" alt="Preview foto profile" class="h-full w-full object-cover">
                            </template>
                            <div x-show="!preview" class="grid h-full w-full place-items-center text-5xl font-extrabold text-[#ee4d2d]">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        </div>
                        <label for="profile_photo" class="mt-4 inline-flex cursor-pointer rounded-xl bg-[#ee4d2d] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#d94325]">Upload Foto</label>
                        <input id="profile_photo" name="profile_photo" type="file" accept="image/*" @change="preview = URL.createObjectURL($event.target.files[0])" class="sr-only">
                        @error('profile_photo') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="mb-2 block text-sm font-bold text-slate-700">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="market-input">
                            @error('name') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="market-input">
                            @error('email') <p class="mt-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="rounded-2xl bg-[#ee4d2d] px-5 py-3 text-sm font-extrabold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-[#d94325]">Simpan Profile</button>

                        @if (session('status') === 'profile-updated')
                            <span class="ml-3 text-sm font-bold text-emerald-700">Profile berhasil diperbarui.</span>
                        @endif
                    </div>
                </form>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                @include('profile.partials.update-password-form')
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-100">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
