@extends('layouts.app')

@section('content')
    {{-- navbar --}}
    @include('components.navbar')
    {{-- content --}}
    <div class="h-[60px] w-full bg-white"></div>
    <div class="flex flex-col justify-center items-center gap-3">
        <div class="flex flex-col gap-3 p-[5%] justify-center items-center">
            <h3 class="text-[25px] md:text-[38px] uppercase font-semibold text-center">selamat datang di perpustakaan digital unjaya</h3>
            <p class="text-[14px] md:text-[16px] text-center w-[80%]">Temukan e-book, jurnal, dan sumber belajar terkini untuk perjalanan akademismu. Mari mulai petualangan literasi digitalmu sekarang!</p>
        </div>
        <div class="flex items-center justify-center w-full">
            @include('components.searchbar')
        </div>
        <p class="font-bold">atau</p>
        <p class="font-bold">Melihat beberapa kategori buku paling populer</p>

        {{-- Jenis Buku Items --}}
        <div class="flex items-center justify-center">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach ($jenisbukus as $jenisbuku)
                    <a href="/category/{{ $jenisbuku->namajenisbuku }}" class="bg-white overflow-hidden w-[250px] h-[80px] flex border-2 rounded-sm justify-between shadow-md">
                        <div class="">
                            <p class="py-[12px] pl-[16px] font-[450] text-[12px] font-sans capitalize">{{ $jenisbuku->namajenisbuku }}</p>
                        </div>

                        <div class="relative w-full max-w-[50%]">
                            <img src="storage/QFvdBHDIbH.png" alt="" class="w-[5rem] rotate-12 shadow-lg drop-shadow-lg absolute bottom-[-45px] right-4">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
@endsection

