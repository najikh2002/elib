<div class="h-full w-full z-50 fixed hidden" id="penerbit_addmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <form class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[60%]" id="penerbit_form">
                @csrf

                <div class="flex w-full gap-3">
                    <!-- Nama Penerbit -->
                    <div class="mb-4 w-full">
                        <label for="namapenerbit" class="block text-gray-600 font-semibold mb-2">Tambah Penerbit</label>
                        <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namapenerbit" name="namapenerbit" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button id="tambah_penerbit" type="button" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Add
                    </button>
                    <button type="button" id="hide_penerbitaddmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
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
        function reloadPenerbitDropdown() {
            $.ajax({
                url: '/seller/listpenerbit',
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
                         $('#kodepenerbit').empty();

                        $('#kodepenerbit').append($('<option>', {
                            value: '',
                            text: '-- Pilih Penerbit --'
                        }));

                        options.forEach(function (option) {
                            $('#kodepenerbit').append($('<option>', {
                                value: option.kodepenerbit,
                                text: option.namapenerbit
                            }));
                        });
                    } else {
                        console.log('Gagal mendapat response data');
                    }
                },
                error: function (error) {
                    console.error('Gagal mendapatkan opsi penerbit', error);
                }
            });
        }

        $('#tambah_penerbit').click(function(e) {
            e.preventDefault();

            let namapenerbit   = $('#namapenerbit').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({

                url: `/seller/buatpenerbit`,
                type: 'POST',
                cache: false,
                data: {
                    "namapenerbit": namapenerbit,
                    "_token": token
                },
                success:function(response){
                    alert('Jenis Buku BERHASIL ditambahkan!');
                    reloadPenerbitDropdown();
                },
                error:function(error){
                    alert('Jenis Buku GAGAL ditambahkan!');
                }

            });

            $('#penerbit_addmodal').hide();
        });
    </script>
@endpush
