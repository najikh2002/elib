@php
    $buku_link = [
        'Pengarang',
        'Subyek',
        'Penerbit',
        'Jenis Buku',
        'Bahasa',
        'Sumber Perolehan',
    ];

    $buku_path = [
        '/seller/pengarang',
        '/seller/subyek',
        '/seller/penerbit',
        '/seller/jenisbuku',
        '/seller/bahasa',
        '/seller/sumberperolehan'
    ];

    $laporan_link = [
        'Total Baca',
        'Total Baca Per User',
        'Total Baca Per Konten',
        'Total Buku',
        'Total Anggota',
        'Total Pengunjung',
        'Peminjaman (Detail)',
        'Pembaca',
        'Peminjam',
        'Pengunjung',
    ];

    $laporan_path = [
        '/seller/pengarang',
        '/seller/laporan-totalbacaperuser',
        '/seller/laporan-totalbacaperkonten',
        '/seller/laporan-totalbuku',
        '/seller/bahasa',
        '/seller/sumberperolehan',
        '/seller/laporan-peminjaman',
        '/seller/2',
        '/seller/3',
        '/seller/4',
    ];

    $bukus = [
        'link' => $buku_link,
        'path' => $buku_path,
    ];

    $laporans = [
        'link' => $laporan_link,
        'path' => $laporan_path
    ];
@endphp

<nav class="bg-gray-800 text-white p-4 w-[400px]">
    <ul>
        <li><a class="flex items-center gap-2 py-2 rounded-md px-4 hover:bg-gray-600" href="/seller"><i class="fa fa-pie-chart" aria-hidden="true"></i>Dashboard</a></li>
        <li><a class="flex gap-2 items-center py-2 rounded-md px-4 hover:bg-gray-600" href="/seller/buku"><i class="fa fa-book" aria-hidden="true"></i>Buku</a></li>
        <li  id="show_buku_dropdown"><button type="button" class="flex justify-between w-full items-center py-2 rounded-md px-4 hover:bg-gray-600"><span class="flex gap-2 items-center"><i class="fa fa-server" aria-hidden="true"></i>Referensi Buku </span><i class="fa fa-caret-down" aria-hidden="true"></i></button type="button"></li>
        <li id="buku_dropdown">
            @foreach ($bukus['link'] as $index => $link)
            <a href="{{ $bukus['path'][$index] }}" class="block py-2 rounded-md pl-12 hover:bg-gray-600">{{ $link }}</a>
            @endforeach
        </li>
        <li><a class="flex gap-2 items-center py-2 rounded-md px-4 hover:bg-gray-600" href="/seller/anggota"><i class="fa-solid fa-user"></i> Anggota</a></li>
        <li  id="show_laporan_dropdown"><button type="button" class="flex justify-between w-full items-center py-2 rounded-md px-4 hover:bg-gray-600"><span class="flex gap-2 items-center"><i class="fa fa-archive" aria-hidden="true"></i>Laporan </span><i class="fa fa-caret-down" aria-hidden="true"></i></button type="button"></li>
        <li id="laporan_dropdown">
            @foreach ($laporans['link'] as $index => $link)
            <a href="{{ $laporans['path'][$index] }}" class="block py-2 rounded-md pl-12 hover:bg-gray-600">{{ $link }}</a>
            @endforeach
        </li>
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
        $(window).on('load', function () {
            let bukuIsActive = localStorage.getItem('bukuIsActive') === 'true' || false;
            let laporanIsActive = localStorage.getItem('laporanIsActive') === 'true' || false;

            if (bukuIsActive) {
                $('#buku_dropdown').show();
            } else {
                $('#buku_dropdown').hide();
            }

            if (laporanIsActive) {
                $('#laporan_dropdown').show();
            } else {
                $('#laporan_dropdown').hide();
            }

            $('#show_buku_dropdown').on('click', function (event) {
                event.preventDefault();
                bukuIsActive = !bukuIsActive;

                if (bukuIsActive) {
                    $('#buku_dropdown').slideDown();
                } else {
                    $('#buku_dropdown').slideUp();
                }

                localStorage.setItem('bukuIsActive', bukuIsActive);
            });

            $('#show_laporan_dropdown').on('click', function (event) {
                event.preventDefault();
                laporanIsActive = !laporanIsActive;

                if (laporanIsActive) {
                    $('#laporan_dropdown').slideDown();
                } else {
                    $('#laporan_dropdown').slideUp();
                }

                localStorage.setItem('laporanIsActive', laporanIsActive);
            });
        });
    });

</script>
@endpush
