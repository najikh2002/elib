<nav class="w-full bg-white flex fixed top-0 justify-between items-center px-[5%] h-[60px] border-b-[1px] z-50">
    <a href="/home" class="flex justify-center items-center gap-2">
        <img src="{{ asset('storage/logo.svg') }}" alt="" class="w-[35px] h-[35px]">
        <div class="flex flex-col relative h-full w-full">
            <span class="absolute top-[-20px] text-[20px] tracking-wide font-bold">UNJAYA</span>
            <p class="absolute w-full top-1 left-[42px] text-[#24702b] text-[9px] font-bold">eLibrary</p>
        </div>
    </a>

    <label class="absolute top-3 right-[5%] group">
        <span class="text-[20px]">
            @if ($anggota->foto)
            @php
                $fotoPath = str_replace('public/', '', $anggota->foto);
                $assetPath = asset("storage/{$fotoPath}");
            @endphp
                <img src="{{ $assetPath }}" alt="" class="w-[35px] h-[35px] object-cover rounded-full">
            @else
                <i class="fa-solid fa-user"></i>
            @endif
        </span>
        <input type="checkbox" name="" id="" class="peer opacity-0">
            <div class="absolute hidden peer-checked:block right-0 top-9 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <a href="/profile" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Profile</a>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="text-gray-700 block w-full px-4 py-2 text-left text-sm" type="submit">Logout</button>
                    </form>
                </div>
            </div>
    </label>
</nav>
