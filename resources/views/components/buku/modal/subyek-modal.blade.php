<div class="h-full w-full z-50 fixed hidden" id="subyek_addmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <form class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[60%]]" id="subyek_form">

                <div class="flex w-full gap-3">
                    <!-- Nama Sumber Perolehan -->
                    <div class="mb-4 w-full">
                        <label for="namasubyek" class="block text-gray-600 font-semibold mb-2">Tambah Subyek</label>
                        <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namasubyek" name="namasubyek" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="subyek_tambah" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Add
                    </button>
                    <button type="button" id="hide_subyekaddmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        // SUBYEK ACTION
        function reloadSubyekDropdown() {
            $.ajax({
                url: '/seller/listsubyek',
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
                         $('#kodesubyek').empty();

                        $('#kodesubyek').append($('<option>', {
                            value: '',
                            text: '-- Pilih Subyek --'
                        }));
                        options.forEach(function (option) {
                            $('#kodesubyek').append($('<option>', {
                                value: option.kodesubyek,
                                text: option.namasubyek
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

        $('#subyek_tambah').click(function(e) {
            e.preventDefault();

            let namasubyek   = $('#namasubyek').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({

                url: `/seller/buatsubyek`,
                type: 'POST',
                cache: false,
                data: {
                    "namasubyek": namasubyek,
                    "_token": token
                },
                success:function(response){
                    alert('Jenis Buku BERHASIL ditambahkan!');
                    reloadSubyekDropdown();
                },
                error:function(error){
                    alert('Jenis Buku GAGAL ditambahkan!');
                }

            });

            $('#subyek_addmodal').hide();
        });
    </script>
@endpush
