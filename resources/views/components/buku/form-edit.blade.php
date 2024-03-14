<div id="buku_editmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[90%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full h-full overflow-scroll" enctype="multipart/form-data" id="form_editbuku">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Judul Buku -->
                <div class="mb-4">
                    <label for="judulbuku_edit" class="block text-gray-600 font-semibold mb-2">Judul Buku</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="judulbuku_edit" name="judulbuku_edit" required>
                </div>

                <!-- Tahun -->
                <div class="mb-4">
                    <label for="tahun_edit" class="block text-gray-600 font-semibold mb-2">Tahun</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="tahun_edit" name="tahun_edit" required>
                </div>

                <!-- Edisi -->
                <div class="mb-4">
                    <label for="edisi_edit" class="block text-gray-600 font-semibold mb-2">Edisi</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="edisi_edit" name="edisi_edit" required>
                </div>

                <!-- ISBN -->
                <div class="mb-4">
                    <label for="isbn_edit" class="block text-gray-600 font-semibold mb-2">ISBN</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="isbn_edit" name="isbn_edit" required>
                </div>

                <!-- Jumlah Halaman -->
                <div class="mb-4">
                    <label for="jumlahhalaman_edit" class="block text-gray-600 font-semibold mb-2">Jumlah Halaman</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="jumlahhalaman_edit" name="jumlahhalaman_edit" required>
                </div>

                <!-- Jumlah Exemplar -->
                <div class="mb-4">
                    <label for="jumlahexemplar_edit" class="block text-gray-600 font-semibold mb-2">Jumlah Exemplar</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="jumlahexemplar_edit" name="jumlahexemplar_edit" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Sumber Perolehan -->
                <div class="mb-4">
                    <label for="namasumberperolehan" class="block text-gray-600 font-semibold mb-2">Sumber Perolehan</label>
                    <div class="flex gap-2">
                        <select class="select2-single-in-buku-form-add" name="state" style="width:100%;" id="sumberperolehan_edit" name="sumberperolehan_edit">
                            <option value="">-- Pilih Sumber Perolehan --</option>
                            @foreach ($sumberperolehans as $sp)
                            <option value="{{ $sp->kodesumberperolehan }}">{{ $sp->namasumberperolehan }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_spaddmodal_edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Pengarang -->
                <div class="mb-4 flex flex-col">
                    <label for="namapengarang" class="block text-gray-600 font-semibold mb-2">Pengarang</label>
                    <div class="flex gap-2">
                        <select class="select2-multiple-in-buku-form-add" name="pengarang_edit[]" multiple="multiple" id="pengarang_edit" style="width:100%;padding: 5px">
                            @foreach ($pengarangs as $pengarang)
                                <option value="{{ $pengarang->kodepengarang }}">{{ $pengarang->namapengarang }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_pengarangaddmodal_edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Penerbit -->
                <div class="mb-4 flex flex-col">
                    <label for="namapenerbit" class="block text-gray-600 font-semibold mb-2">Penerbit</label>
                    <div class="flex gap-2">
                        <select class="select2-multiple-in-buku-form-add" name="penerbit_edit" id="penerbit_edit" style="width:100%;padding: 5px">
                            <option value="">-- Pilih Penerbit --</option>
                            @foreach ($penerbits as $penerbit)
                                <option value="{{ $penerbit->kodepenerbit }}">{{ $penerbit->namapenerbit }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_penerbitaddmodal_edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Jenis Buku -->
                <div class="mb-4">
                    <label for="kodejenisbuku" class="block text-gray-600 font-semibold mb-2">Jenis Buku</label>
                    <div class="flex gap-3">
                        <select class="select2-single-in-buku-form-add" id="jenisbuku_edit" name="jenisbuku_edit" style="width: 100%">
                            <option value="">-- Pilih Jenis Buku --</option>
                            @foreach($jenisbukus as $jenisbuku)
                                <option value="{{ $jenisbuku->kodejenisbuku }}">{{ $jenisbuku->namajenisbuku }}</option>
                            @endforeach
                        </select>

                        <button id="show_jenisbukuaddmodal" type="button" class="text-[20px] text-slate-500 font-bold" id="show_penerbitaddmodal_edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Subyek -->
                <div class="mb-4">
                    <label for="kodesubyek" class="block text-gray-600 font-semibold mb-2">Subyek</label>
                    <div class="flex gap-3">
                        <select class="select2-single-in-buku-form-add" style="width: 100%;padding: 5px" id="subyek_edit" name="subyek_edit" >
                            <option value="">-- Pilih Subyek --</option>
                            @foreach($subyeks as $subyek)
                            <option value="{{ $subyek->kodesubyek }}">{{ $subyek->namasubyek }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_subyekaddmodal_edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Bahasa -->
                <div class="mb-4">
                    <label for="kodebahasa" class="block text-gray-600 font-semibold mb-2">Bahasa</label>
                    <div class="flex gap-3">
                        <select class="select2-single-in-buku-form-add" style="width: 100%" id="bahasa_edit" name="bahasa_edit" >
                            <option value="">-- Pilih Bahasa --</option>
                            @foreach($bahasas as $bahasa)
                                <option value="{{ $bahasa->kodebahasa }}">{{ $bahasa->namabahasa }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_psaddmodal_edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>
            <!-- Program Studi -->
            <div class="mb-4">
                <label for="programstudi" class="block text-gray-600 font-semibold mb-2">Program Studi</label>
                <select class="select2-multiple-in-buku-form-add" style="width:100%" name="programstudi_edit[]" multiple="multiple" id="programstudi_edit">
                    @foreach($programstudis as $programstudi)
                        <option value="{{ $programstudi->kodeps }}">{{ $programstudi->namaps }}</option>
                    @endforeach
                </select>

            </div>

            {{-- Sinopsis --}}
            <div>
                <label for="sinopsis" class="block text-gray-600 font-semibold mb-2">Sinopsis</label>
                <textarea id="sinopsis_edit" name="sinopsis_edit" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                {{-- <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="sinopsis" name="sinopsis" required> --}}
            </div>

            {{-- Input File --}}
            <div class="flex w-full my-4">
                <input type="file" name="filebuku" id="filebuku" accept=".pdf">
                <div>
                    <img src="" alt="" id="sampulbuku" class="w-[200px] p-3 bg-slate-200">
                </div>
            </div>

            {{-- Tampilkan --}}
            <div class="flex flex-col my-3">
                <label class="block text-gray-600 font-semibold mb-2">Tampilkan</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="active" id="active_edit" name="active_edit" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                  </label>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Update
                </button>
                <button id="hide_buku_editmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        function initializeSelect2(selector, data, selectedValue) {
            $(selector).val(selectedValue).trigger('change');
            $(selector).select2({
                data: [{
                    id: selectedValue,
                    text: data
                }]
            });
        }

        function initializeMultipleSelect2(selector, data, selectedValue) {
            $(selector).val(selectedValue).trigger('change');
            $(selector).select2({
                multiple: true,
                data: [{
                    id: selectedValue,
                    text: data
                }]
            });
            console.log(selectedValue);
        }

        $(document).on('click','.show_buku_editmodal',function(){
            let id = $(this).attr('id');
            console.log('klik');

            $('#form_editbuku').submit(function (e) {
                        e.preventDefault();

                        let token   = $("meta[name='csrf-token']").attr("content");
                        var formData = new FormData(this);

                        let pengarang = [];
                        let programstudi = [];

                        $('#pengarang_edit option:selected').each(function () {
                            pengarang.push($(this).val());
                        });

                        $('#programstudi_edit option:selected').each(function () {
                            programstudi.push($(this).val());
                        });

                        for (let i = 0; i < pengarang.length; i++) {
                            formData.append('pengarang_edit[]', pengarang[i]);
                        }

                        for (let i = 0; i < programstudi.length; i++) {
                            formData.append('programstudi_edit[]', programstudi[i]);
                        }

                        formData.append("_token", token);
                        formData.append("kodebuku", id);
                        formData.append("judulbuku_edit", $('#judulbuku_edit').val());
                        formData.append("tahun_edit", $('#tahun_edit').val());
                        formData.append("edisi_edit", $('#edisi_edit').val());
                        formData.append("isbn_edit", $('#isbn_edit').val());
                        formData.append("jumlahhalaman_edit", $('#jumlahhalaman_edit').val());
                        formData.append("jumlahexemplar_edit", $('#jumlahexemplar_edit').val());
                        formData.append("sumberperolehan_edit", $('#sumberperolehan_edit').val());
                        formData.append("penerbit_edit", $('#penerbit_edit').val());
                        formData.append("jenisbuku_edit", $('#jenisbuku_edit').val());
                        formData.append("subyek_edit", $('#subyek_edit').val());
                        formData.append("bahasa_edit", $('#bahasa_edit').val());
                        formData.append("sinopsis_edit", $('#sinopsis_edit').val());
                        formData.append("active_edit", $('#active_edit').val());

                        $.ajax({
                            url: '/seller/updatebuku',
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
                                    alert('BUKU BERHASIL DIUPDATE!');
                                    $('#buku_editmodal').hide();
                                    $('#buku_editmodal').fadeOut(500, function() {
                                        location.reload(true);
                                    });
                                } else {
                                    alert('BUKU GAGAL DIUPDATE!');
                                }
                            },
                            error: function (error) {
                                console.log(error);

                            }
                        });
                        $('#modal_editbuku').hide();
            });

            $.ajax({
                url:`/seller/editbuku/${id}`,
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
                        $('#form_editbuku')[0].reset();

                        buku = data.buku;
                        databuku = data.databuku;
                        let baseUrl = window.location.origin;

                        let coverBook = `${baseUrl}/storage/${buku.sampulbuku}`

                        $('#sampulbuku').attr('src', coverBook);
                        $('#judulbuku_edit').val(buku.judulbuku);
                        $('#tahun_edit').val(buku.tahun);
                        $('#edisi_edit').val(buku.edisi);
                        $('#isbn_edit').val(buku.isbn);
                        $('#jumlahhalaman_edit').val(buku.jumlahhalaman);
                        $('#jumlahexemplar_edit').val(buku.jumlahexemplar);

                        initializeSelect2('#sumberperolehan_edit', databuku.sumberperolehan.namasumberperolehan, databuku.sumberperolehan.kodesumberperolehan);
                        initializeSelect2('#penerbit_edit', databuku.penerbit.namapenerbit, databuku.penerbit.kodepenerbit);
                        initializeSelect2('#jenisbuku_edit', databuku.jenisbuku.namajenisbuku, databuku.jenisbuku.kodejenisbuku);
                        initializeSelect2('#penerbit_edit', databuku.penerbit.namapenerbit, databuku.penerbit.kodepenerbit);
                        initializeSelect2('#subyek_edit', databuku.subyek.namasubyek, databuku.subyek.kodesubyek);
                        initializeSelect2('#bahasa_edit', databuku.bahasa.namabahasa, databuku.bahasa.kodebahasa);

                        initializeMultipleSelect2('#pengarang_edit', databuku.pengarang.namapengarang, databuku.pengarang.kodepengarang);
                        initializeMultipleSelect2('#programstudi_edit', databuku.programstudi.namaps, databuku.programstudi.kodeps);

                        $('#sinopsis_edit').val(buku.sinopsis);
                        $('#active_edit').prop('checked', buku.active);

                        $('#kodesumberperolehan_edit').val(buku.kodesumberperolehan);
                        $('#kodejenisbuku_edit').val(buku.kodejenisbuku);
                        $('#kodesubyek_edit').val(buku.kodesubyek);
                        $('#kodebahasa_edit').val(buku.kodebahasa);

                        $('#buku_editmodal').show();

                    }else{
                        alert(msg);
                    }


                }
            });
        });

        $('#hide_buku_editmodal').click(function() {
            $('#buku_editmodal').hide();
        });
    </script>

    {{-- BTN HANDLER --}}
    <script>
        // SUMBER PEROLEHAN BTN
        $('#show_spaddmodal_edit').on('click', () => {
            $('#sp_addmodal').show();
            $('#sp_form')[0].reset();
        });

        $('#hide_spaddmodal_edit').on('click', () => {
            $('#sp_addmodal').hide();
        });

        // PENGARANG BTN
        $('#show_pengarangaddmodal_edit').on('click', () => {
            $('#pengarang_addmodal').show();
            $('#pengarang_form')[0].reset();
        });

        $('#hide_pengarangaddmodal_edit').on('click', () => {
            $('#pengarang_addmodal').hide();
        });

        // SUBYEK BTN
        $('#show_subyekaddmodal_edit').on('click', () => {
            $('#subyek_addmodal').show();
            $('#subyek_form')[0].reset();
        });

        $('#hide_subyekaddmodal_edit').on('click', () => {
            $('#subyek_addmodal').hide();
        });

        // PENERBIT BTN
        $('#show_penerbitaddmodal_edit').on('click', () => {
            $('#penerbit_addmodal').show();
            $('#penerbit_form')[0].reset();
        });

        $('#hide_penerbitaddmodal_edit').on('click', () => {
            $('#penerbit_addmodal').hide();
        });

        // BAHASA BTN
        $('#show_bahasaaddmodal_edit').on('click', () => {
            $('#bahasa_addmodal').show();
            $('#bahasa_form')[0].reset();
        });

        $('#hide_bahasaaddmodal_edit').on('click', () => {
            $('#bahasa_addmodal').hide();
        });

        // JENISBUKU BTN
        $('#show_jenisbukuaddmodal_edit').on('click', () => {
            $('#jenisbuku_addmodal').show();
            $('#jenisbuku_form')[0].reset();
        });

        $('#hide_jenisbukuaddmodal_edit').on('click', () => {
            $('#jenisbuku_addmodal').hide();
        });
    </script>
@endpush
