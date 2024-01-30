<div class="flex flex-col gap-3">
    <h3 class="font-semibold text-[20px] pb-4">Buku yang dipinjam</h3>
    <div class="flex flex-col gap-3 items-center md:items-start">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach ($pinjams as $pinjam)
                {{-- item --}}
                <a href="/detail/{{ $pinjam->kodebuku }}" class="flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100">
                    <img src="storage/{{ data_get($pinjam->buku, 'sampulbuku') }}" alt="" class="object-cover w-full h-full">
                    <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $pinjam->buku->judulbuku }}</h3>
                    @if($pinjam->buku->bukupengarang->count() > 1)
                        <p class="line-clamp-1 py-1">{{ $pinjam->buku->bukupengarang[0]->pengarang->namapengarang }} dan {{ $buku->bukupengarang->count() - 1 }} lainnya</p>
                    @else
                        <p class="line-clamp-1 py-1">{{ $pinjam->buku->bukupengarang[0]->pengarang->namapengarang }}</p>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</div>
