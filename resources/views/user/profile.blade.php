@extends('layouts.app')

@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
@endpush

@section('content')
    @include('components.navbar')
    <div class="container mx-auto my-8 p-8 bg-white shadow-md rounded-md">
        <div class="flex flex-col md:flex-row w-full gap-12">
            <div class="flex flex-col justify-center items-center">
                @if ($anggota->foto)
                    <img src="{{ $anggota->foto }}" alt="" class="w-[100px] h-[100px] object-cover rounded-full">
                @else
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="w-[100px] h-[100px] object-cover rounded-full">
                @endif
            </div>

            <div class="flex flex-col">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Informasi Akun</h3>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $anggota['nama'] }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $anggota['email'] }}</td>
                        </tr>

                        <tr>
                            <td>TTL</td>
                            <td>: {{ $anggota['tempatlahir'] }}, {{ $anggota['tgllahir'] }}</td>
                        </tr>

                        <tr>
                            <td>Angkatan</td>
                            <td>: {{ $anggota['kodeangkatan'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-8 p-8 bg-white shadow-md rounded-md">
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-12">Pengaturan</h3>
            <div class="container" id="profile_form">
                <div class="mb-5">
                    <label for="old_password" class="block mb-2 text-sm text-gray-900 dark:text-white">Password Lama</label>
                    <input type="password" id="old_password" name="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="new_password" class="block mb-2 text-sm text-gray-900 dark:text-white">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <div class="mb-5">
                    <label for="confirm_password" class="block mb-2 text-sm text-gray-900 dark:text-white">Konfirmasi Password Baru</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                </div>
                <button type="button" id="update_pass" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui</button>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-8 p-8 bg-white shadow-md rounded-md">
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Riwayat Peminjaman</h3>
            <table id="profile_table" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">No</th>
                        <th class="py-2 px-4 border-b text-start">Sampul</th>
                        <th class="py-2 px-4 border-b text-start">Judul Buku</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $key => $buku)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if ($buku->sampulbuku)
                                <div class="w-[60px]">
                                    <img src="{{ asset("storage/$buku->sampulbuku") }}" alt="Sampul Buku" class="object-cover">
                                </div>
                            @else
                                <div class="w-[60px]">
                                    <img src="{{ asset('storage/cover.png') }}" alt="Sampul Buku" class="object-cover">
                                </div>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $buku->judulbuku }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#profile_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#update_pass").click(function() {
                console.log('klik');

                let token   = $("meta[name='csrf-token']").attr("content");
                let old_password = $("#old_password").val();
                let new_password = $("#new_password").val();
                let confirm_password = $("#confirm_password").val();

                if (!old_password || !new_password || !confirm_password) {
                    alert('Harap isi semua field.');
                    return;
                }

                if(new_password != confirm_password) {
                    $("#new_password").val('');
                    $("#confirm_password").val('');
                    alert('Konfirmasi Password tidak sesuai!');
                    return;
                }

                $.ajax({
                    url: `/profile-password`,
                    method: "POST",
                    cahce: false,
                    data: {
                        _token: token,
                        old_password: old_password,
                        new_password: new_password,
                        confirm_password: confirm_password,
                    },
                    success: function(response) {
                        if(response.success) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                        location.reload(true)
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endpush
