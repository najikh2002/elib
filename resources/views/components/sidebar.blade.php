@php
    $links = [
        'Pengarang',
        'Subyek',
        'Penerbit',
        'Jenis Buku',
        'Bahasa',
        'Sumber Perolehan',
    ];

    $paths = [
        '/seller/pengarang',
        '/seller/subyek',
        '/seller/penerbit',
        '/seller/jenisbuku',
        '/seller/bahasa',
        '/seller/sumberperolehan'
    ];

    $items = [
        'link' => $links,
        'path' => $paths,
    ];
@endphp

<nav class="bg-gray-800 text-white p-4 w-[400px]">
    <ul>
        <li><a class="flex items-center gap-2 py-2 rounded-md px-4 hover:bg-gray-600" href="/seller"><i class="fa fa-pie-chart" aria-hidden="true"></i>
            Dashboard</a></li>
        <li><a class="flex gap-2 items-center py-2 rounded-md px-4 hover:bg-gray-600" href="/seller/buku"><i class="fa fa-book" aria-hidden="true"></i>
            Buku</a></li>
            <li  id="show"><button type="button" class="flex justify-between w-full items-center py-2 rounded-md px-4 hover:bg-gray-600"><span class="flex gap-2 items-center"><i class="fa fa-server" aria-hidden="true"></i>
                Referensi Buku </span><i class="fa fa-caret-down" aria-hidden="true"></i>
            </button type="button"></li>
            <li id="dropdown">
                @foreach ($items['link'] as $index => $link)
                <a href="{{ $items['path'][$index] }}" class="block py-2 rounded-md pl-12 hover:bg-gray-600">{{ $link }}</a>
                @endforeach
            </li>

        <li><a class="flex gap-2 items-center py-2 rounded-md px-4 hover:bg-gray-600" href="/seller/anggota"><i class="fa-solid fa-user"></i> Anggota</a></li>
        <li><form action="/logout" method="POST" class="w-full mt-12">
            @csrf
            <button type="submit" class="flex w-full gap-2 items-center py-2 rounded-md px-4 hover:bg-gray-600">
                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
            </button>
        </form></li>
    </ul>
</nav>

@push('script-seller')
<script>

    $(document).ready(function () {
        let isActive = false;

        $('#show').on('click', function () {
            isActive = !isActive;

            if (isActive) {
                $('#dropdown').slideDown();
            } else {
                $('#dropdown').slideUp();
            }
        });
    });
</script>
@endpush
