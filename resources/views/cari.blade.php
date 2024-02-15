@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center w-full">
    @include('components.searchbar')
</div>
<div class="flex flex-col gap-3 px-3 md:px-[5%] py-3">
    @if (count($data) > 0)
        <h3 class="font-bold">Ditemukan {{ count($data) }} buku dari pencarian "{{ $search_input }}"</h3>
    @else
        <h3 class="font-bold">Buku tidak ditemukan</h3>
    @endif
    <div class="flex md:grid flex-col sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 grid-auto-flow-dense justify-start items-center gap-12 md:items-start">
        @if (count($data) > 0)
            {{-- Display books here --}}
            @foreach ($data as $buku)
                <a href="/detail/{{ $buku->kodebuku }}" class="flex-shrink-0 flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100 w-full h-fit md:w-[300px] md:h-[500px]">
                    @if($buku->sampulbuku)
                        <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover w-full h-full">
                    @else
                        <img src="{{ asset('storage/cover.png') }}" alt="Sampul Buku" class="object-cover w-full h-full">
                    @endif

                    <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $buku->judulbuku }}</h3>
                    @php
                        $authors = explode(', ', $buku->namapengarang);
                        $authorCount = count($authors);
                    @endphp
                    <p class="line-clamp-1 py-1">
                        @if ($authorCount)
                            {{ $authors[0] }}
                            @if ($authorCount > 1)
                                @if ($authorCount == 2)
                                    dan {{ $authors[1] }}
                                @else
                                    dan {{ $authorCount - 1 }} lainnya
                                @endif
                            @endif
                        @endif
                    </p>
                </a>
            @endforeach
        @endif
    </div>
</div>

@endsection
