@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center w-full">
    @include('components.searchbar')
</div>
<div class="flex flex-col gap-3">
    {{-- Cek apakah ada buku yang ditemukan --}}
    @if ($data)
        {{-- cek buku ditemukan berdasarkan apa --}}
        @if (count($data['judulbuku']) > 0)
            <h3 class="font-semibold text-[20px] pb-4">Berdasarkan Judul</h3>

            <div class="flex flex-col gap-3 items-center md:items-start">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach ($data['judulbuku'] as $buku)
                        {{-- item --}}
                        <a href="/detail/{{ $buku->kodebuku }}" class="flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100">
                            <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover w-full h-full">
                            <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $buku->judulbuku }}</h3>
                            @if($buku->bukupengarang->count() > 1)
                                <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }} dan {{ $buku->bukupengarang->count() - 1 }} lainnya</p>
                            @else
                                <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if (count($data['jenisbuku']) > 0)
            <h3 class="font-semibold text-[20px] pb-4">Berdasarkan Jenis Buku</h3>

            <div class="flex flex-col gap-3 items-center md:items-start">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach ($data['jenisbuku'] as $buku)
                        {{-- item --}}
                        <a href="/detail/{{ $buku->kodebuku }}" class="flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100">
                            <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover w-full h-full">
                            <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $buku->judulbuku }}</h3>
                            @if($buku->bukupengarang->count() > 1)
                                <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }} dan {{ $buku->bukupengarang->count() - 1 }} lainnya</p>
                            @else
                                <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if (count($data['pengarangbuku']) > 0)
            <h3 class="font-semibold text-[20px] pb-4">Berdasarkan Penulis</h3>

            <div class="flex flex-col gap-3 items-center md:items-start">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach ($data['pengarangbuku'] as $buku)
                        {{-- item --}}
                        <a href="/detail/{{ $buku->kodebuku }}" class="flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100">
                            <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover w-full h-full">
                            <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $buku->judulbuku }}</h3>
                            @if($buku->bukupengarang->count() > 1)
                                <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }} dan {{ $buku->bukupengarang->count() - 1 }} lainnya</p>
                            @else
                                <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }}</p>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <h3>Buku tidak ditemukan</h3>
    @endif
</div>

@endsection
