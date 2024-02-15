@extends('layouts.app')

@section('content')
    {{-- overlay --}}
    <div class="flex w-full h-[60px] bg-white"></div>
    {{-- navbar --}}
    @include('components.navbar-login')
    {{-- content --}}
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col gap-3 p-[5%] justify-center items-center">
            <h3 class="text-[25px] md:text-[38px] uppercase font-semibold text-center">selamat datang di perpustakaan digital unjaya</h3>
            <p class="text-[14px] md:text-[16px] text-center w-[80%]">Temukan e-book, jurnal, dan sumber belajar terkini untuk perjalanan akademismu. Mari mulai petualangan literasi digitalmu sekarang!</p>
            @include('components.searchbar')
        </div>
        <div class="py-4 px-[5%]">
            <div class="max-w-7xl gap-3">
                <div class="flex flex-col gap-3 w-full">
                    @if ($pinjamcount)
                        @include('components.item-pinjam')
                    @else
                        @include('components.item-pinjam-null')
                    @endif
                    @include('components.item')
                </div>
            </div>
        </div>
    </div>
@endsection

