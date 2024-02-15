@extends('layouts.seller')

@section('content-seller')
    <!-- Kode Jenis Buku -->
    <div class="py-6 px-3 w-full">
        <h3 class="text-gray-600 font-semibold py-3">Total Baca Per User</h3>
        <div>
            <table id="v_totalbacaperuser" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">Username</th>
                        <th class="py-2 px-4 border-b text-start">Nama</th>
                        <th class="py-2 px-4 border-b">Total Baca</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $anggota)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $anggota->useracc }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->totalpinjam }}</td>
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
            $('#v_totalbacaperuser').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
