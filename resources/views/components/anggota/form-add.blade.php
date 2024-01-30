<div id="anggota_addmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[95%]">
        <form id="anggota_addform" class="bg-white p-6 rounded-md shadow-md w-full md:w-[80%] h-full overflow-scroll">

            <div class="grid grid-cols-2 gap-3">
                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-600 font-semibold mb-2">Nama</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="nama" name="nama" required>
                </div>

                <!-- Intituasal -->
                <div class="mb-4">
                    <label for="institusiasal" class="block text-gray-600 font-semibold mb-2">Institusiasal</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="institusiasal" name="institusiasal" required>
                </div>

                <!-- Kode Angkatan -->
                <div class="mb-4">
                    <label for="kodeangkatan" class="block text-gray-600 font-semibold mb-2">Kode Angkatan</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="kodeangkatan" name="kodeangkatan" required>
                </div>

                <!-- nova -->
                <div class="mb-4">
                    <label for="nova" class="block text-gray-600 font-semibold mb-2">Nomor Variabel</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="nova" name="nova" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
                    <input type="email" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="email" name="email" required>
                </div>

                <!-- Nomor HP -->
                <div class="mb-4">
                    <label for="nohp" class="block text-gray-600 font-semibold mb-2">Nomor HP</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="nohp" name="nohp" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-4">
                    <label for="tempatlahir" class="block text-gray-600 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tempatlahir" name="tempatlahir" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <label for="tgllahir" class="block text-gray-600 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tgllahir" name="tgllahir" required>
                </div>

                <!-- Tanggal Aktif -->
                <div class="mb-4">
                    <label for="tglaktif" class="block text-gray-600 font-semibold mb-2">Tanggal Aktif</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tglaktif" name="tglaktif" required>
                </div>

                <!-- Tanggal Kadaluarsa -->
                <div class="mb-4">
                    <label for="tglkadaluwarsa" class="block text-gray-600 font-semibold mb-2">Tanggal Kadaluarsa</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tglkadaluwarsa" name="tglkadaluwarsa" required>
                </div>
            </div>
            <!-- Foto -->
            <div class="mb-4">
                <label for="foto" class="block text-gray-600 font-semibold mb-2">Foto</label>
                <input type="file" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="foto" name="foto" required>
            </div>

            <!-- Program Studi -->
            <div class="mb-4">
                <label for="kodeps" class="block text-gray-600 font-semibold mb-2">Program Studi</label>
                <select name="" id="kodeps" class="select2-single-in-anggota-form-add" style="width: 100%;text-align:center">
                    <option value="#">Pilih Program Studi</option>
                    @foreach ($programstudis as $ps)
                        <option value="{{ $ps['kodeps'] }}">{{ $ps["namaps"] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="useracc" class="block text-gray-600 font-semibold mb-2">Username</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="useracc" name="useracc" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="userpass" class="block text-gray-600 font-semibold mb-2">Password</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="userpass" name="userpass" required>
            </div>

            <!-- Program Studi -->
            <div class="mb-4">
                <label for="kodepriv" class="block text-gray-600 font-semibold mb-2">Role Anggota</label>
                <select name="" id="kodepriv" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full">
                        <option value="3">user</option>
                        <option value="2">admin</option>
                        <option value="1">super-admin</option>
                </select>
            </div>

            {{-- Status --}}
            <div class="flex flex-col my-3">
                <label class="block text-gray-600 font-semibold mb-2">Status</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="status" id="status" name="status" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Submit
                </button>
                <button id="hide_anggota_addmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    {{-- ACTION HANDLER --}}
    <script>
        $(document).ready(function() {
            $('.select2-multiple-in-buku-form-add').select2();
        });

        $(document).ready(function() {
            $('.select2-single-in-anggota-form-add').select2();
        });
    </script>

    {{-- FORM ACTION --}}
    <script>
        $(document).ready(function () {
            $('#anggota_addform').submit(function (e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let formData = new FormData();

                formData.append("_token", token);
                formData.append("nama", $('#nama').val());
                formData.append("kodeangkatan", $('#kodeangkatan').val());
                formData.append("institusiasal", $('#institusiasal').val());
                formData.append("nova", $('#nova').val());
                formData.append("email", $('#email').val());
                formData.append("nohp", $('#nohp').val());
                formData.append("tempatlahir", $('#tempatlahir').val());
                formData.append("tgllahir", $('#tgllahir').val());

                formData.append( 'foto', $( '#foto' )[0].files[0] );

                formData.append("tglaktif", $('#tglaktif').val());
                formData.append("tglkadaluwarsa", $('#tglkadaluwarsa').val());
                formData.append("kodeps", $('#kodeps').val());
                formData.append("kodepriv", $('#kodepriv').val());
                formData.append("useracc", $('#useracc').val());
                formData.append("userpass", $('#userpass').val());
                formData.append("status", $('#status').is(':checked') ? 'active' : 'inactive');

                $.ajax({
                    url: '/seller/buatanggota',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let res = response;

                        let status = res.success;
                        let message = res.message;
                        let data = res.data;

                        if (status) {
                            alert('Anggota Baru BERHASIL dibuat!');
                        } else {
                            alert('Anggota Baru GAGAL dibuat!');
                        }
                        $('#anggota_addmodal').hide();
                        $('#anggota_addmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    },
                });
            });
        });
    </script>

@endpush
