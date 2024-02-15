@extends('layouts.seller')

@section('content-seller')
    <!-- Kode Jenis Buku -->
    <div class="py-6 px-3 w-full">
        <h3 class="text-gray-600 font-semibold py-3">Total Buku</h3>
        <div>
            <table id="v_totalbuku" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">Jenis Buku</th>
                        <th class="py-2 px-4 border-b text-start">Jumlah Buku</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $buku)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $buku->namajenisbuku }}</td>
                        <td class="py-2 px-4 border-b">{{ $buku->jmlbuku }}</td>
                        <td class="py-2 px-4 border-b"><a href="#">Detail</a></td>
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
            $('#v_totalbuku').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
