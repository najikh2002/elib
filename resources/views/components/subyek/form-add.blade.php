<div id="subyek_addmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form id="subyek_form" class="bg-white p-6 rounded-md shadow-md w-full md:w-[50%]">
            <!-- Input Kode Jenis Buku -->
            <div class="mb-4">
                <label for="namasubyek" class="block text-gray-600 font-semibold mb-2">Nama Subjek</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namasubyek" name="namasubyek" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Submit
                </button>
                <button id="hideAddModal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).ready(function () {
            $('#subyek_form').submit(function (e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let formData = new FormData();

                formData.append("_token", token);
                formData.append("namasubyek", $('#namasubyek').val());

                $.ajax({
                    url: '/seller/buatsubyek',
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
                            alert('Subyek BERHASIL dibuat!');
                        } else {
                            alert('Subyek GAGAL dibuat!');
                        }
                        $('#subyek_addmodal').hide();
                        $('#subyek_addmodal').fadeOut(500, function() {
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
