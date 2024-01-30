@extends('layouts.seller')

@section('content-seller')
    {{-- form --}}
    @include('components.buku.form-add')
    @include('components.buku.form-edit')
    @include('components.modal.importbuku')

    @include('components.buku.modal.sp-modal')
    @include('components.buku.modal.pengarang-modal')
    @include('components.buku.modal.penerbit-modal')
    @include('components.buku.modal.jenisbuku-modal')
    @include('components.buku.modal.subyek-modal')
    @include('components.buku.modal.bahasa-modal')

    <div class="py-6 px-3 w-full">
        <div class="flex gap-3 justify-start items-center">
            <button class="text-[20px] text-slate-500 font-bold" id="show_addbuku"><i class="fa fa-plus" aria-hidden="true"></i></button>
            <button class="text-[20px] text-slate-500 font-bold" id="show_buku_importmodal"><i class="fa-solid fa-file-import"></i></button>
        </div>
        <button>import</button>
        <h3 class="text-gray-600 font-semibold py-3">Buku</h3>

        <table id="buku_table" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-start">#</th>
                    <th class="py-2 px-4 border-b text-start">Sampul</th>
                    <th class="py-2 px-4 border-b text-start">Judul Buku</th>
                    <th class="py-2 px-4 border-b text-start">Penulis</th>
                    <th class="py-2 px-4 border-b text-start">Penerbit</th>
                    <th class="py-2 px-4 border-b text-start">Tahun Terbit</th>
                    <th class="py-2 px-4 border-b text-start">ISBN</th>
                    <th class="py-2 px-4 border-b text-start">Jenis Buku</th>
                    <th class="py-2 px-4 border-b text-start">Subjek</th>
                    <th class="py-2 px-4 border-b text-start">Action</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($bukus as $buku)
                    <tr>
                        <td>{{ $buku->kodebuku }}</td>
                        <td>
                            @if ($buku->sampulbuku)
                                <div class="w-[60px] p-1 bg-slate-400">
                                    <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover">
                                </div>
                            @else
                                <div class="w-[60px] bg-black text-white">
                                    Ini Gambar Sampul
                                </div>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $buku->judulbuku }}</td>
                        <td class="py-2 px-4 border-b">
                            <ul>
                                @foreach ($buku->bukupengarang as $index => $bp)
                                <li>{{ $bp->pengarang->namapengarang }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-2 px-4 border-b">{{ $buku->penerbit->namapenerbit }}</td>
                        <td>{{ $buku->tahun }}</td>
                        <td>{{ $buku->isbn }}</td>
                        <td>{{ data_get($buku->jenisbuku, 'namajenisbuku') }}</td>
                        <td>{{ data_get($buku->subyek, 'namasubyek') }}</td>
                        <td class="">
                            <div class="flex gap-2">
                                <button id="{{ $buku->kodebuku }}" type="button" class="show_buku_editmodal bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="submit" id="{{ $buku->kodebuku }}" class="hapus_buku bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
@endsection

@push('script-seller')
    <script>
        // TABLE HADNLER
        $(document).ready(function() {
            $('#buku_table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

        // BTN HANDLER
        $('#show_addbuku').click(function() {
            $('#modal_addbuku').show();
        });

        $(document).on('click', '.show_buku_editmodal', () => {
            $('#buku_editmodal').show();
        });

        $('#hide_addbuku').click(function() {
            $('#modal_addbuku').hide();
        });

        $(document).on('click', '#show_buku_importmodal', () => {
                $('#buku_importmodal').show();
            });
    </script>

    <script>
        $(document).ready(function () {
            $('.hapus_buku').on('click', function () {
                let id = $(this).attr('id');

                // Tampilkan konfirmasi
                if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: `/seller/buku/${id}`,
                        type: 'DELETE',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function (response) {
                            let status = response.success;

                            if (status) {
                                alert('BUKU BERHASIL DIHAPUS!');
                            } else {
                                alert('BUKU GAGAL DIHAPUS!');
                            }
                            location.reload(true);
                        },
                        error: function (error) {
                            console.error('Error:', error);

                            // Handle error accordingly
                        }
                    });
                }
            });
        });
    </script>


@endpush
