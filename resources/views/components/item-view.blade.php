@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col-reverse gap-6 md:gap-0 md:flex-row">
            {{-- Desc --}}
            <div class="basis-3/4 flex flex-col gap-[100px] md:pr-12">
                {{-- Title --}}
                <div class="flex flex-col gap-[50px]">
                    <h3 class="text-[48px] font-light font-serif">{{ $buku->judulbuku }}</h3>
                    <p>Oleh
                        @foreach ($buku->bukupengarang as $key => $bp)
                        <a href="#" class="underline font-semibold">
                            {{ $bp->pengarang->namapengarang }}
                            @if($loop->last)

                            @else
                            ,
                            @endif
                        </a>
                    @endforeach
                    </p>
                </div>
                {{-- Sinopsis --}}
                <div class="flex flex-col gap-[50px]">
                    <h3 class="text-[28px] font-light font-serif">Sinopsis</h3>
                    <p class="w-[95%] text-justify">{{ $buku->sinopsis }}</p>
                </div>
                {{-- Table --}}
                <div>
                    <table class="min-w-full bg-white border border-gray-300">
                        {{-- table heading --}}
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b text-start">Bahasa</th>
                                <th class="py-2 px-4 border-b text-start">Penerbit</th>
                                <th class="py-2 px-4 border-b text-start">Tahun Rilis</th>
                                <th class="py-2 px-4 border-b text-start">ISBN</th>
                            </tr>
                        </thead>
                        {{-- table body --}}
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b text-start">{{ $buku->bahasa->namabahasa}}</td>
                                <td class="py-2 px-4 border-b text-start">{{ $buku->penerbit->namapenerbit }}</td>
                                <td class="py-2 px-4 border-b text-start">{{ $buku->tahun }}</td>
                                <td class="py-2 px-4 border-b text-start">{{ $buku->isbn }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            {{-- Thumbnail --}}
            <div class="flex flex-col basis-1/4 justify-center items-center shadow-md rounded-md h-fit pb-12 pt-3 gap-3 bg-slate-100">
                @if ($buku->sampulbuku)
                        <div class="p-2 bg-slate-100 mb-12 w-[95%]">
                            <div class="relative w-full h-80">
                                <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover w-full h-full">
                            </div>
                        </div>
                        @else
                        <div class="p-2 bg-slate-200 mb-12 w-[95%]">
                            <div class="relative w-full h-80">
                                <img src="https://media.istockphoto.com/id/949082660/id/foto/3d-rendering-buku-kosong-pada-latar-belakang-putih.jpg?s=612x612&w=0&k=20&c=l6S4HOgdkDICfqTzi2DONFfEgDt5Okbct24h1kFVCw0=" alt="Sampul Buku" class="object-cover w-full h-full">
                            </div>
                        </div>
                        @endif


                @if ($pinjam)
                    <a href="/detail/{{ $buku->kodebuku }}/read" class="py-2 w-[200px] rounded-md text-center bg-green-600 uppercase text-white hover:opacity-80 transition-all duration-200">Baca</a>
                    <form action="/user/hapus-sesi/{{ $buku->kodebuku }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="py-2 w-[200px] rounded-md bg-red-500 uppercase text-white hover:opacity-80 transition-all duration-200 text-center">Kembalikan</button>
                @else
                    <a href="/user/pinjam/{{ $buku->kodebuku }}" class="py-2 w-[200px] rounded-md bg-black uppercase text-white hover:opacity-80 transition-all duration-200 text-center">Pinjam</a>
                @endif
                </form>
            </div>
        </div>
    </div>
@endsection
