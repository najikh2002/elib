<div class="flex flex-col gap-3 w-full">
    <h3 class="font-semibold text-[20px] pb-4">Buku yang tersedia</h3>
    <div class="flex flex-col gap-3 items-center md:items-start w-full">
        <div class="flex flex-col md:flex-row justify-start items-center gap-6 md:items-start md:max-w-[90vw] overflow-x-auto">
            @foreach ($bukus as $buku)
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
        </div>
    </div>
</div>



