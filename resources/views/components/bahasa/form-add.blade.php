<div id="bahasa_addmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form id="bahasa_addform" class="bg-white p-6 rounded-md shadow-md w-full md:w-[50%]">
            <!-- Input Kode Jenis Buku -->
            <div class="mb-4">
                <label for="namabahasa" class="block text-gray-600 font-semibold mb-2">Nama Bahasa</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namabahasa" name="namabahasa" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Submit
                </button>
                <button id="hide_bahasa_addmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).ready(function () {
            $('#bahasa_addform').submit(function (e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let formData = new FormData();

                formData.append("_token", token);
                formData.append("namabahasa", $('#namabahasa').val());

                $.ajax({
                    url: '/seller/buatbahasa',
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
                            alert('Bahasa BERHASIL dibuat!');
                        } else {
                            alert('Bahasa GAGAL dibuat!');
                        }
                        $('#bahasa_addmodal').hide();
                        $('#bahasa_addmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    },
                });
            });
        });

        $('#hide_bahasa_addmodal').click(function() {
            $('#bahasa_addmodal').hide();
        });
    </script>
@endpush

