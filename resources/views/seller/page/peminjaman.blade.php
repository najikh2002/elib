@extends('layouts.seller')

@section('content-seller')
    <!-- Kode Jenis Buku -->
    <div class="py-6 px-3 w-full">
        <h3 class="text-gray-600 font-semibold py-3">Total Buku</h3>
        <div>
            <table id="v_peminjaman" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">Judul Buku</th>
                        <th class="py-2 px-4 border-b text-start">Penulis</th>
                        <th class="py-2 px-4 border-b text-start">Nama Peminjam</th>
                        <th class="py-2 px-4 border-b">Tanggal Mulai Pinjam</th>
                        <th class="py-2 px-4 border-b">Tanggal Akhir Pinjam</th>
                        <th class="py-2 px-4 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $buku)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $buku->judulbuku }}</td>
                        <td class="py-2 px-4 border-b">{{ $buku->namapengarang }}</td>
                        <td class="py-2 px-4 border-b">{{ $buku->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $buku->tglpinjam }}</td>
                        <td class="py-2 px-4 border-b">{{ $buku->tglkembali }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($buku->tglkembali)
                                Sudah Dikembalikan
                            @else
                                Belum Dikembalikan
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('script-seller')
    <script>
        $(document).ready(function() {
            $('#v_peminjaman').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
