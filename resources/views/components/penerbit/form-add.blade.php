<div id="penerbit_addmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full md:w-[80%]" id="penerbit_addform">

            <div class="flex flex-col w-full gap-3">
                <!-- Nama Penerbit -->
                <div class="mb-4">
                    <label for="namapenerbit" class="block text-gray-600 font-semibold mb-2">Nama Penerbit</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namapenerbit" name="namapenerbit" required>
                </div>

                <!-- Alamat Penerbit -->
                <div class="mb-4">
                    <label for="alamatpenerbit" class="block text-gray-600 font-semibold mb-2">Alamat Penerbit</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="alamatpenerbit" name="alamatpenerbit">
                </div>

                <!-- Kota Penerbit -->
                <div class="mb-4">
                    <label for="kota" class="block text-gray-600 font-semibold mb-2">Kota Penerbit</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="kota" name="kota">
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Submit
                </button>
                <button id="hide_penerbit_addmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).ready(function () {
            $('#penerbit_addform').submit(function (e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let formData = new FormData();

                formData.append("_token", token);
                formData.append("namapenerbit", $('#namapenerbit').val());
                formData.append("alamatpenerbit", $('#alamatpenerbit').val());
                formData.append("kota", $('#kota').val());

                $.ajax({
                    url: '/seller/buatpenerbit',
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
                            alert('Penerbit BERHASIL dibuat!');
                        } else {
                            alert('Penerbit GAGAL dibuat!');
                        }
                        $('#penerbit_addmodal').hide();
                        $('#penerbit_addmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    },
                });
            });
        });

        $('#hide_penerbit_addmodal').click(function() {
            $('#penerbit_addmodal').hide();
        });
    </script>
@endpush
