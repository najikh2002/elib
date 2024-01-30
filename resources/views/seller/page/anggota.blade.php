@extends('layouts.seller')

@section('content-seller')
    @include('components.anggota.form-add')
    @include('components.anggota.form-edit')
    @include('components.modal.importanggota')

    <!-- Kode Jenis Buku -->
    <div class="py-6 px-3 w-full">
        <div class="flex gap-3 justify-start items-center">
            <button class="text-[20px] text-slate-500 font-bold" id="show_anggota_addmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
            <button class="text-[20px] text-slate-500 font-bold" id="show_anggota_importmodal"><i class="fa-solid fa-file-import"></i></button>
        </div>
        <h3 class="text-gray-600 font-semibold py-3">Anggota</h3>
        <div>
            <table id="anggota_table" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="py-2 px-4 border-b text-start">Nama</th>
                        <th class="py-2 px-4 border-b text-start">Role</th>
                        <th class="py-2 px-4 border-b text-start">Username</th>
                        <th class="py-2 px-4 border-b text-start">Password</th>
                        <th class="py-2 px-4 border-b text-start">Status</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggotas as $key => $anggota)
                    <tr>
                        <td>{{ $anggota->kodeanggota }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->accapp->mpriv["namapriv"] }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->useracc }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->accapp["userpass"] }}</td>
                        <td class="py-2 px-4 border-b">{{ $anggota->status }}</td>
                        <td class="">
                            <div class="flex gap-2">
                                <button id="{{ $anggota->kodeanggota }}" class="show_anggota_editmodal bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <button type="button" id="{{ $anggota->kodeanggota }}" class="hapus_anggota bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
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
    // TABLE HADNLER
    $(document).ready(function() {
        $('#anggota_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );

    $(document).on('click', '.show_anggota_editmodal', () => {
        $('#anggota_editmodal').show();
    });

    $(document).on('click', '#hide_anggota_editmodal', () => {
        $('#anggota_editmodal').hide();
    });

    $(document).on('click', '#show_anggota_addmodal', () => {
        $('#anggota_addmodal').show();
    });

    $(document).on('click', '#hide_anggota_addmodal', () => {
        $('#anggota_addmodal').hide();
    });

    $(document).on('click', '#show_anggota_importmodal', () => {
        $('#anggota_importmodal').show();
    });
</script>

<script>
    $(document).ready(function () {
        $('.hapus_anggota').on('click', function () {
            let id = $(this).attr('id');

            if (confirm('Apakah Anda yakin ingin menghapus anggota ini?')) {
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: `/seller/anggota/${id}`,
                    type: 'DELETE',
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function (response) {
                        console.log(response);
                        let status = response.success;

                        if (status) {
                            alert('ANGGOTA BERHASIL DIHAPUS!');
                        } else {
                            alert('ANGGOTA GAGAL DIHAPUS!');
                        }
                        location.reload(true);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
</script>

@endpush
