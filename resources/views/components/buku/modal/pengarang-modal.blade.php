<div class="h-full w-full z-50 fixed hidden" id="pengarang_addmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <form class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[60%]" id="pengarang_form">
                @csrf

                <div class="flex w-full gap-3">
                    <!-- Nama Pengarang -->
                    <div class="mb-4 w-full">
                        <label for="namapengarang" class="block text-gray-600 font-semibold mb-2">Tambah Pengarang</label>
                        <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namapengarang" name="namapengarang" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="tambah_pengarang" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Add
                    </button>
                    <button type="button" id="hide_pengarangaddmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        // PENGARANG ACTION
        function reloadPengarangDropdown() {
            $.ajax({
                url: '/seller/listpengarang',
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
                         $('#kodepengarang').empty();

                        options.forEach(function (option) {
                            $('#kodepengarang').append($('<option>', {
                                value: option.kodepengarang,
                                text: option.namapengarang
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

        $('#tambah_pengarang').click(function(e) {
            e.preventDefault();

            let namapengarang   = $('#namapengarang').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({

                url: `/seller/buatpengarang`,
                type: 'POST',
                cache: false,
                data: {
                    "namapengarang": namapengarang,
                    "_token": token
                },
                success:function(response){
                    alert('Jenis Buku BERHASIL ditambahkan!');
                    reloadPengarangDropdown();
                },
                error:function(error){
                    alert('Jenis Buku GAGAL ditambahkan!');
                }

            });

            $('#pengarang_addmodal').hide();
        });
    </script>
@endpush
