<div id="pengarang_addmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full md:w-[50%]" id="pengarang_form">

            <div class="flex flex-col w-full gap-3">
                <!-- Nama Pengarang -->
                <div class="mb-4">
                    <label for="namapengarang" class="block text-gray-600 font-semibold mb-2">Nama Pengarang</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namapengarang" name="namapengarang" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-4">
                    <label for="tempatlhr" class="block text-gray-600 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tempatlhr" name="tempatlhr">
                </div>

                <!-- TTL -->
                <div class="mb-4">
                    <label for="tanggallhr" class="block text-gray-600 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tanggallhr" name="tanggallhr">
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Submit
                </button>
                <button id="hide_pengarang_addmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).ready(function () {
            $('#pengarang_form').submit(function (e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let formData = new FormData();

                formData.append("_token", token);
                formData.append("namapengarang", $('#namapengarang').val());
                formData.append("tempatlhr", $('#tempatlhr').val());
                formData.append("tanggallhr", $('#tanggallhr').val());

                $.ajax({
                    url: '/seller/buatpengarang',
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
                            alert('Pengarang BERHASIL dibuat!');
                        } else {
                            alert('Pengarang GAGAL dibuat!');
                        }
                        $('#pengarang_addmodal').hide();
                        $('#pengarang_addmodal').fadeOut(500, function() {
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
@endpush
