<div class="h-full w-full z-50 fixed hidden" id="jenisbuku_addmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <form class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[60%]" id="jenisbuku_form">

                <div class="flex w-full gap-3">
                    <!-- Jenis Buku -->
                    <div class="mb-4 w-full">
                        <label for="namajenisbuku" class="block text-gray-600 font-semibold mb-2">Tambah Jenis Buku</label>
                        <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namajenisbuku" name="namajenisbuku" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="jenisbuku_tambah" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Add
                    </button>
                    <button type="button" id="hide_jenisbukuaddmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        // JENIS BUKU ACTION
        function reloadJenisBukuDropdown() {
            $.ajax({
                url: '/seller/listjenisbuku',
                method: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    res = response;
                },
                complete:function(){
                    status = res.success;
                    options = res.data;
                    message = res.message;

                    if(status) {
                         $('#kodejenisbuku').empty();

                        $('#kodejenisbuku').append($('<option>', {
                            value: '',
                            text: '-- Pilih Jenis Buku --'
                        }));
                        options.forEach(function (option) {
                            $('#kodejenisbuku').append($('<option>', {
                                value: option.kodejenisbuku,
                                text: option.namajenisbuku
                            }));
                        });
                    } else {
                        console.log('Gagal mendapat response data');
                    }
                },
                error: function (error) {
                    console.error('Gagal mendapatkan opsi jenis buku', error);
                }
            });
        }

        $('#jenisbuku_tambah').click(function(e) {
            e.preventDefault();

            let namajenisbuku   = $('#namajenisbuku').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({

                url: `/seller/buatjenisbuku`,
                type: 'POST',
                cache: false,
                data: {
                    "namajenisbuku": namajenisbuku,
                    "_token": token
                },
                success:function(response){
                    alert('Jenis Buku BERHASIL ditambahkan!');
                    reloadJenisBukuDropdown();
                },
                error:function(error){
                    alert('Jenis Buku GAGAL ditambahkan!');
                }

            });

            $('#jenisbuku_addmodal').hide();
        });
    </script>
@endpush
