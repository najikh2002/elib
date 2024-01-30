<div class="flex flex-col gap-3 w-full">
    <h3 class="font-semibold text-[20px] pb-4">Buku yang tersedia</h3>
    <div class="flex flex-col gap-3 items-center md:items-start w-full">
        <div class="flex flex-col md:flex-row justify-center items-center gap-3 md:items-start w-full">
            @foreach ($bukus as $buku)
                {{-- item --}}
                <a href="/detail/{{ $buku->kodebuku }}" class="flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100 w-[200px] h-[300px]">
                    @if($buku->sampulbuku)
                        <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover w-full h-full">
                    @else
                        <img src="{{ asset('storage/cover.png') }}" alt="Sampul Buku" class="object-cover w-full h-full">
                    @endif

                    <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $buku->judulbuku }}</h3>
                    {{-- @if($buku->bukupengarang->count() > 1)
                        <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }} dan {{ $buku->bukupengarang->count() - 1 }} lainnya</p>
                    @else
                        <p class="line-clamp-1 py-1">{{ $buku->bukupengarang[0]->pengarang->namapengarang }}</p>
                    @endif --}}
                </a>
            @endforeach
        </div>
    </div>
</div>


