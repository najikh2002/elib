<div class="h-full w-full z-50 fixed hidden" id="bahasa_addmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <form class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[60%]" id="bahasa_form">

                <div class="flex w-full gap-3">
                    <!-- Nama Sumber Perolehan -->
                    <div class="mb-4 w-full">
                        <label for="namabahasa" class="block text-gray-600 font-semibold mb-2">Tambah Bahasa</label>
                        <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namabahasa" name="namabahasa" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="tambah_bahasa" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Add
                    </button>
                    <button type="button" id="hide_bahasaaddmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        $('#tambah_bahasa').click(function(e) {
            e.preventDefault();

            let namabahasa   = $('#namabahasa').val();
            let token   = $("meta[name='csrf-token']").attr("content");

            $.ajax({

                url: `/seller/buatbahasa`,
                type: 'POST',
                cache: false,
                data: {
                    "namabahasa": namabahasa,
                    "_token": token
                },
                success:function(response){
                    alert('Bahasa BERHASIL ditambahkan!');
                    reloadBahasaDropdown();
                },
                error:function(error){
                    alert('Bahasa GAGAL ditambahkan!');
                }

            });

            $('#bahasa_addmodal').hide();
        });
    </script>
@endpush
