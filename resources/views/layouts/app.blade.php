@extends('layouts.main')

@section('content')
    @isset($header)
        <div class="mb-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            {{ $header }}
        </div>
    @endisset

    {{ $slot }}
@endsection
