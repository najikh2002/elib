<div id="modal_addbuku" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12 overflow-scroll">
    <div class="flex justify-center items-center h-[90%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full h-full overflow-scroll" enctype="multipart/form-data" id="buku_form">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Judul Buku -->
                <div class="mb-4">
                    <label for="judulbuku" class="block text-gray-600 font-semibold mb-2">Judul Buku</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="judulbuku" name="judulbuku" required>
                </div>

                <!-- Tahun -->
                <div class="mb-4">
                    <label for="tahun" class="block text-gray-600 font-semibold mb-2">Tahun</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="tahun" name="tahun" required>
                </div>

                <!-- Edisi -->
                <div class="mb-4">
                    <label for="edisi" class="block text-gray-600 font-semibold mb-2">Edisi</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="edisi" name="edisi" required>
                </div>

                <!-- ISBN -->
                <div class="mb-4">
                    <label for="isbn" class="block text-gray-600 font-semibold mb-2">ISBN</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="isbn" name="isbn" required>
                </div>

                <!-- Jumlah Halaman -->
                <div class="mb-4">
                    <label for="jumlahhalaman" class="block text-gray-600 font-semibold mb-2">Jumlah Halaman</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="jumlahhalaman" name="jumlahhalaman" required>
                </div>

                <!-- Jumlah Exemplar -->
                <div class="mb-4">
                    <label for="jumlahexemplar" class="block text-gray-600 font-semibold mb-2">Jumlah Exemplar</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="jumlahexemplar" name="jumlahexemplar" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Sumber Perolehan -->
                <div class="mb-4">
                    <label for="namasumberperolehan" class="block text-gray-600 font-semibold mb-2">Sumber Perolehan</label>
                    <div class="flex gap-2">
                        <select class="select2-single-in-buku-form-add" name="state" style="width:100%;" id="kodesumberperolehan" name="kodesumberperolehan">
                            <option value="">-- Pilih Sumber Perolehan --</option>
                            @foreach ($sumberperolehans as $sp)
                            <option value="{{ $sp->kodesumberperolehan }}">{{ $sp->namasumberperolehan }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_spaddmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Pengarang -->
                <div class="mb-4 flex flex-col">
                    <label for="namapengarang" class="block text-gray-600 font-semibold mb-2">Pengarang</label>
                    <div class="flex gap-2">
                        <select class="select2-multiple-in-buku-form-add" name="kodepengarang[]" multiple="multiple" id="kodepengarang" style="width:100%;padding: 5px">
                            @foreach ($pengarangs as $pengarang)
                                <option value="{{ $pengarang->kodepengarang }}">{{ $pengarang->namapengarang }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_pengarangaddmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Penerbit -->
                <div class="mb-4 flex flex-col">
                    <label for="namapenerbit" class="block text-gray-600 font-semibold mb-2">Penerbit</label>
                    <div class="flex gap-2">
                        <select class="select2-multiple-in-buku-form-add" name="kodepenerbit" id="kodepenerbit" style="width:100%;padding: 5px">
                            <option value="">-- Pilih Penerbit --</option>
                            @foreach ($penerbits as $penerbit)
                                <option value="{{ $penerbit->kodepenerbit }}">{{ $penerbit->namapenerbit }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_penerbitaddmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Jenis Buku -->
                <div class="mb-4">
                    <label for="kodejenisbuku" class="block text-gray-600 font-semibold mb-2">Jenis Buku</label>
                    <div class="flex gap-3">
                        <select class="select2-single-in-buku-form-add" id="kodejenisbuku" name="kodejenisbuku" style="width: 100%">
                            <option value="">-- Pilih Jenis Buku --</option>
                            @foreach($jenisbukus as $jenisbuku)
                                <option value="{{ $jenisbuku->kodejenisbuku }}">{{ $jenisbuku->namajenisbuku }}</option>
                            @endforeach
                        </select>

                        <button id="show_jenisbukuaddmodal" type="button" class="text-[20px] text-slate-500 font-bold" id="show_penerbitaddmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Subyek -->
                <div class="mb-4">
                    <label for="kodesubyek" class="block text-gray-600 font-semibold mb-2">Subyek</label>
                    <div class="flex gap-3">
                        <select class="select2-single-in-buku-form-add" style="width: 100%;padding: 5px" id="kodesubyek" name="kodesubyek" >
                            <option value="">-- Pilih Subyek --</option>
                            @foreach($subyeks as $subyek)
                            <option value="{{ $subyek->kodesubyek }}">{{ $subyek->namasubyek }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_subyekaddmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Bahasa -->
                <div class="mb-4">
                    <label for="kodebahasa" class="block text-gray-600 font-semibold mb-2">Bahasa</label>
                    <div class="flex gap-3">
                        <select class="select2-single-in-buku-form-add" style="width: 100%" id="kodebahasa" name="kodebahasa" >
                            <option value="">-- Pilih Bahasa --</option>
                            @foreach($bahasas as $bahasa)
                                <option value="{{ $bahasa->kodebahasa }}">{{ $bahasa->namabahasa }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="text-[20px] text-slate-500 font-bold" id="show_bahasaaddmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>
            <!-- Program Studi -->
            <div class="mb-4">
                <label for="programstudi" class="block text-gray-600 font-semibold mb-2">Program Studi</label>
                <select class="select2-multiple-in-buku-form-add" style="width:100%" name="programstudi[]" multiple="multiple" id="programstudi">
                    @foreach($programstudis as $programstudi)
                        <option value="{{ $programstudi->kodeps }}">{{ $programstudi->namaps }}</option>
                    @endforeach
                </select>

            </div>

            {{-- Sinopsis --}}
            <div>
                <label for="sinopsis" class="block text-gray-600 font-semibold mb-2">Sinopsis</label>
                <textarea id="sinopsis" name="sinopsis" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                {{-- <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 form-input w-full" id="sinopsis" name="sinopsis" required> --}}
            </div>

            {{-- Input File --}}
            <div class="flex w-full my-4 ">
                <input type="file" name="filebuku" id="filebuku" accept=".pdf">
            </div>

            {{-- Tampilkan --}}
            <div class="flex flex-col my-3">
                <label class="block text-gray-600 font-semibold mb-2">Tampilkan</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="active" id="active" name="active" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                  </label>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Submit
                </button>
                <button id="hide_addbuku" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
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
            $('.select2-single-in-buku-form-add').select2();
        });
    </script>

    {{-- FORM ACTION --}}
    <script>
        $(document).ready(function () {
            $('#buku_form').submit(function (e) {
                e.preventDefault();

                let kodepengarang = [];
                let programstudi = [];

                $('#kodepengarang option:selected').each(function () {
                    kodepengarang.push($(this).val());
                });

                $('#programstudi option:selected').each(function () {
                    programstudi.push($(this).val());
                });

                // Mendapatkan data form
                let token = $("meta[name='csrf-token']").attr("content");

                // Initialize FormData
                let formData = new FormData();

                // Menambahkan setiap nilai dalam array kodepengarang dan programstudi
                for (let i = 0; i < kodepengarang.length; i++) {
                    formData.append('kodepengarang[]', kodepengarang[i]);
                }

                for (let i = 0; i < programstudi.length; i++) {
                    formData.append('programstudi[]', programstudi[i]);
                }

                // Append other form data
                formData.append("_token", token);
                formData.append("kodesumberperolehan", $('#kodesumberperolehan').val());
                formData.append("kodepenerbit", $('#kodepenerbit').val());
                formData.append("kodejenisbuku", $('#kodejenisbuku').val());
                formData.append("kodesubyek", $('#kodesubyek').val());
                formData.append("judulbuku", $('#judulbuku').val());
                formData.append("tahun", $('#tahun').val());
                formData.append("jumlahhalaman", $('#jumlahhalaman').val());
                formData.append("jumlahexemplar", $('#jumlahexemplar').val());
                formData.append("kodebahasa", $('#kodebahasa').val());
                formData.append("active", $('#active').val());
                formData.append("sinopsis", $('#sinopsis').val());
                formData.append("isbn", $('#isbn').val());
                formData.append("edisi", $('#edisi').val());
                formData.append( 'filebuku', $( '#filebuku' )[0].files[0] );

                $.ajax({
                    url: '/seller/buatbuku',
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
                            alert('Buku BERHASIL dibuat!');
                        } else {
                            alert('Buku GAGAL dibuat!');
                        }
                        $('#modal_addbuku').hide();
                        $('#modal_addbuku').fadeOut(500, function() {
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

    {{-- BTN HANDLER --}}
    <script>
        // SUMBER PEROLEHAN BTN
        $('#show_spaddmodal').on('click', () => {
            $('#sp_addmodal').show();
            $('#sp_form')[0].reset();
        });

        $('#hide_spaddmodal').on('click', () => {
            $('#sp_addmodal').hide();
        });

        // PENGARANG BTN
        $('#show_pengarangaddmodal').on('click', () => {
            $('#pengarang_addmodal').show();
            $('#pengarang_form')[0].reset();
        });

        $('#hide_pengarangaddmodal').on('click', () => {
            $('#pengarang_addmodal').hide();
        });

        // SUBYEK BTN
        $('#show_subyekaddmodal').on('click', () => {
            $('#subyek_addmodal').show();
            $('#subyek_form')[0].reset();
        });

        $('#hide_subyekaddmodal').on('click', () => {
            $('#subyek_addmodal').hide();
        });

        // PENERBIT BTN
        $('#show_penerbitaddmodal').on('click', () => {
            $('#penerbit_addmodal').show();
            $('#penerbit_form')[0].reset();
        });

        $('#hide_penerbitaddmodal').on('click', () => {
            $('#penerbit_addmodal').hide();
        });

        // BAHASA BTN
        $('#show_bahasaaddmodal').on('click', () => {
            $('#bahasa_addmodal').show();
            $('#bahasa_form')[0].reset();
        });

        $('#hide_bahasaaddmodal').on('click', () => {
            $('#bahasa_addmodal').hide();
        });

        // JENISBUKU BTN
        $('#show_jenisbukuaddmodal').on('click', () => {
            $('#jenisbuku_addmodal').show();
            $('#jenisbuku_form')[0].reset();
        });

        $('#hide_jenisbukuaddmodal').on('click', () => {
            $('#jenisbuku_addmodal').hide();
        });
    </script>
@endpush

