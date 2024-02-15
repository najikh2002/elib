<div id="anggota_editmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[95%]">
        <form id="anggota_editform" class="bg-white p-6 rounded-md shadow-md w-full md:w-[80%] h-full overflow-scroll">

            <div class="grid grid-cols-2 gap-3">
                <!-- Nama -->
                <div class="mb-4">
                    <label for="nama" class="block text-gray-600 font-semibold mb-2">Nama</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="nama_edit" name="nama_edit" required>
                </div>

                <!-- Intituasal -->
                <div class="mb-4">
                    <label for="institusiasal" class="block text-gray-600 font-semibold mb-2">Institusiasal</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="institusiasal_edit" name="institusiasal" required>
                </div>

                <!-- Kode Angkatan -->
                <div class="mb-4">
                    <label for="kodeangkatan" class="block text-gray-600 font-semibold mb-2">Kode Angkatan</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="kodeangkatan_edit" name="kodeangkatan" required>
                </div>

                <!-- nova -->
                <div class="mb-4">
                    <label for="nova" class="block text-gray-600 font-semibold mb-2">Nomor Variabel</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="nova_edit" name="nova" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
                    <input type="email" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="email_edit" name="email" required>
                </div>

                <!-- Nomor HP -->
                <div class="mb-4">
                    <label for="nohp" class="block text-gray-600 font-semibold mb-2">Nomor HP</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="nohp_edit" name="nohp" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-4">
                    <label for="tempatlahir" class="block text-gray-600 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tempatlahir_edit" name="tempatlahir" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <label for="tgllahir" class="block text-gray-600 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tgllahir_edit" name="tgllahir" required>
                </div>

                <!-- Tanggal Aktif -->
                <div class="mb-4">
                    <label for="tglaktif" class="block text-gray-600 font-semibold mb-2">Tanggal Aktif</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tglaktif_edit" name="tglaktif" required>
                </div>

                <!-- Tanggal Kadaluarsa -->
                <div class="mb-4">
                    <label for="tglkadaluwarsa" class="block text-gray-600 font-semibold mb-2">Tanggal Kadaluarsa</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tglkadaluwarsa_edit" name="tglkadaluwarsa" required>
                </div>
            </div>
            <!-- Foto -->
            <div class="mb-4">
                <label for="foto_edit" class="block text-gray-600 font-semibold mb-2">Foto</label>
                <input type="file" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="foto_edit" name="foto">
                <div id="currentFotoContainer" class="mt-2">
                    <!-- Tampilkan foto yang sudah ada atau pesan placeholder -->
                    <img id="currentFoto" src="" alt="Current Foto" class="max-w-[200px]">
                </div>
            </div>

            <!-- Program Studi -->
            <div class="mb-4">
                <label for="kodeps" class="block text-gray-600 font-semibold mb-2">Program Studi</label>
                <select name="" id="kodeps_edit" class="select2-single-in-anggota-form-add" style="width: 100%;text-align:center">
                    <option value="#">Pilih Program Studi</option>
                    @foreach ($programstudis as $ps)
                        <option value="{{ $ps['kodeps'] }}">{{ $ps["namaps"] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="useracc" class="block text-gray-600 font-semibold mb-2">Username</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full cursor-not-allowed" id="useracc_edit" name="useracc" disabled>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="userpass" class="block text-gray-600 font-semibold mb-2">Password</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="userpass_edit" name="userpass" required>
            </div>

            <!-- Program Studi -->
            <div class="mb-4">
                <label for="kodepriv" class="block text-gray-600 font-semibold mb-2">Role Anggota</label>
                <select name="" id="kodepriv_edit" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full">
                        <option value="3">user</option>
                        <option value="2">admin</option>
                        <option value="1">super-admin</option>
                </select>
            </div>

            {{-- Status --}}
            <div class="flex flex-col my-3">
                <label class="block text-gray-600 font-semibold mb-2">Status</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="status" id="status_edit" name="status" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Update
                </button>
                <button id="hide_anggota_editmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).on('click','.show_anggota_editmodal',function(){
            let id = $(this).attr('id');

            function updateFotoPreview(input) {
                var currentFotoContainer = $('#currentFotoContainer');
                var currentFoto = $('#currentFoto');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        currentFoto.attr('src', e.target.result);
                        currentFotoContainer.show();
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    currentFotoContainer.hide();
                }
            }

            function initializeSelect2(selector, data, selectedValue) {
                $(selector).val(selectedValue).trigger('change');
                $(selector).select2({
                    data: [{
                        id: selectedValue,
                        text: data
                    }]
                });
            }

            $('#anggota_editform').submit(function (e) {
                        e.preventDefault();

                        let token   = $("meta[name='csrf-token']").attr("content");
                        var formData = new FormData(this);

                        // Append other form data
                        formData.append("_token", token);
                        formData.append("kodeanggota_edit", id);
                        formData.append("nama_edit", $('#nama_edit').val());
                        formData.append("institusiasal_edit", $('#institusiasal_edit').val());
                        formData.append("kodeangkatan_edit", $('#kodeangkatan_edit').val());
                        formData.append("nova_edit", $('#nova_edit').val());
                        formData.append("email_edit", $('#email_edit').val());
                        formData.append("nohp_edit", $('#nohp_edit').val());
                        formData.append("tempatlahir_edit", $('#tempatlahir_edit').val());
                        formData.append("tgllahir_edit", $('#tgllahir_edit').val());
                        formData.append("tglaktif_edit", $('#tglaktif_edit').val());
                        formData.append("tglkadaluwarsa_edit", $('#tglkadaluwarsa_edit').val());
                        formData.append("kodeps_edit", $('#kodeps_edit').val());
                        formData.append("useracc_edit", $('#useracc_edit').val());
                        formData.append("userpass_edit", $('#userpass_edit').val());
                        formData.append("kodepriv_edit", $('#kodepriv_edit').val());
                        formData.append("active_edit", $('#active_edit').val());
                        formData.append("foto_edit", $('#foto_edit').val());

                        $.ajax({
                            url: '/seller/updateanggota',
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
                                    alert('ANGGOTA BERHASIL DIUPDATE!');
                                } else {
                                    alert('ANGGOTA GAGAL DIUPDATE!');
                                }
                            },
                            error: function (error) {
                                console.log(error);

                            }
                        });
                        $('#anggota_editmodal').hide();
                        $('#anggota_editmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
            });

            function initializeSelect2(selector, data, selectedValue) {
                $(selector).val(selectedValue).trigger('change');
                $(selector).select2({
                    data: [{
                        id: selectedValue,
                        text: data
                    }]
                });
            }

            $.ajax({
                url:`/seller/editanggota/${id}`,
                method:'GET',
                dataType:'JSON',
                success:function(response){
                    res = response;
                },
                complete:function(){
                    status = res.status;
                    data = res.data;
                    msg = res.msg;

                    if(status){
                        $('#anggota_editform')[0].reset();

                        anggota = data;
                        let foto = `http://localhost:8000/storage/${anggota.foto}`
                        $('#foto_edit').on('change', function() {
                            var input = this;
                            var imgContainer = $('#currentFoto');

                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    imgContainer.attr('src', e.target.result);
                                }

                                reader.readAsDataURL(input.files[0]);
                            } else {
                                // Jika tidak ada file yang dipilih, tampilkan placeholder atau sesuai kebutuhan
                                imgContainer.attr('src', foto);
                            }
                        });

                        $('#nama_edit').val(anggota.nama);
                        $('#institusiasal_edit').val(anggota.institusiasal);
                        $('#kodeangkatan_edit').val(anggota.kodeangkatan);
                        $('#nova_edit').val(anggota.nova);
                        $('#email_edit').val(anggota.email);
                        $('#nohp_edit').val(anggota.nohp);
                        $('#tempatlahir_edit').val(anggota.tempatlahir);
                        $('#tgllahir_edit').val(anggota.tgllahir);
                        $('#tglaktif_edit').val(anggota.tglaktif);
                        $('#tglkadaluwarsa_edit').val(anggota.tglkadaluwarsa);
                        $('#kodeps_edit').val(anggota.kodeps);
                        $('#useracc_edit').val(anggota.useracc);
                        $('#userpass_edit').val(anggota.userpass);
                        $('#kodepriv_edit').val(anggota.kodepriv);
                        $('#currentFoto').attr('src', foto);
                        // $('#active_edit').val(anggota.);
                        initializeSelect2('#kodeps_edit', anggota.dataps, anggota.kodeps);

                        $('#editmodal').show();

                    }else{
                        alert(msg);
                    }


                }
            });
        });
    </script>
@endpush
