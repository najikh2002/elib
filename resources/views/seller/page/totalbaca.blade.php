@extends('layouts.seller')

@section('content-seller')
    <!-- Kode Jenis Buku -->
    <div class="py-6 px-3 w-full">
        <h3 class="text-gray-600 font-semibold py-3">Total Baca</h3>
        <div>
            <table id="v_peminjaman" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">Tanggal</th>
                        <th class="py-2 px-4 border-b text-start">Jumlah Buku Dibaca</th>
                        <th class="py-2 px-4 border-b text-start">Jumlah Pembaca</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $baca)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $baca->tanggal }}</td>
                        <td class="py-2 px-4 border-b">{{ $baca->jumlah_anggota }}</td>
                        <td class="py-2 px-4 border-b">{{ $baca->jumlah_buku }}</td>
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
