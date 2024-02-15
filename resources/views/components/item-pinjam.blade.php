<div class="flex flex-col gap-3">
    <h3 class="font-semibold text-[20px] pb-4">Buku yang dipinjam</h3>
    <div class="flex flex-col gap-3 items-center md:items-start">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach ($pinjams as $pinjam)
                {{-- item --}}
                <a href="/detail/{{ $pinjam->kodebuku }}" class="flex-shrink-0 flex flex-col justify-center items-center p-6 shadow-md hover:shadow-lg transition-all duration-150 bg-slate-100 w-full h-fit md:w-[300px] md:h-[500px]">
                    <img src="storage/{{ data_get($pinjam->buku, 'sampulbuku') }}" alt="" class="object-cover w-full h-full">
                    <h3 class="line-clamp-1 py-1 pt-3 text-center font-semibold">{{ $pinjam->buku->judulbuku }}</h3>
                    @php
                        $authors = explode(', ', $pinjam->namapengarang);
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
        </div>
    </div>
</div>
