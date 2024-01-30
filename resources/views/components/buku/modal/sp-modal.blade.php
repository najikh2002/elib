<div class="h-full w-full z-50 fixed hidden" id="sp_addmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <form class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[60%]" id="sp_form">

                <div class="flex w-full gap-3">
                    <!-- Nama Sumber Perolehan -->
                    <div class="mb-4 w-full">
                        <label for="namasumberperolehan" class="block text-gray-600 font-semibold mb-2">Tambah Nama Sumber Perolehan</label>
                        <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namasumberperolehan" name="namasumberperolehan" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="sp_tambah" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Add
                    </button>
                    <button type="button" id="hide_spaddmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        // SUMBER PEROLEHAN ACTION
        function reloadSPDropdown() {
            $.ajax({
                url: '/seller/listsumberperolehan',
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
                         $('#kodesumberperolehan').empty();

                        $('#kodesumberperolehan').append($('<option>', {
                            value: '',
                            text: '-- Pilih Sumber Perolehan --'
                        }));
                        options.forEach(function (option) {
                            $('#kodesumberperolehan').append($('<option>', {
                                value: option.kodesumberperolehan,
                                text: option.namasumberperolehan
                            }));
                        });
                    } else {
                        console.log('Gagal mendapat response data');
                    }
                },
                error: function (error) {
                    console.error('Gagal mendapatkan opsi bahasa', error);
                }
            });
        }

        $('#sp_tambah').click(function(e) {
            e.preventDefault();

            let namasumberperolehan   = $('#namasumberperolehan').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({

                url: `/seller/buatsumberperolehan`,
                type: 'POST',
                cache: false,
                data: {
                    "namasumberperolehan": namasumberperolehan,
                    "_token": token
                },
                success:function(response){
                    alert('Sumber Perolehan BERHASIL ditambahkan!');
                    reloadSPDropdown();
                },
                error:function(error){
                    alert('Sumber Perolehan GAGAL ditambahkan!');
                }

            });

            $('#sp_addmodal').hide();
        });
    </script>
@endpush
