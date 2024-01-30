<div class="h-full w-full z-50 fixed hidden" id="buku_importmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <div class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[40%]">

                <div class="flex w-full gap-3">
                    <div class="mb-4 w-full">
                        <label for="databuku" class="block text-gray-600 font-semibold mb-2">Import Data Buku</label>
                        <input type="file" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="databuku" name="databuku" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="import_buku" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Import
                    </button>
                    <button type="button" id="hide_buku_importmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).ready(function() {
            $('#import_buku').click(function() {
                let databuku = $('#databuku').prop('files')[0];

                if (databuku) {
                    let formData = new FormData();
                    formData.append('databuku', databuku);
                    formData.append('_token', $("meta[name='csrf-token']").attr("content"));

                    $.ajax({
                        url: '/import/buku',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            res = response;
                        },
                        complete: function(){
                            let status = res.success;
                            let msg = res.message;

                            if (status) {
                                alert('BUKU BERHASIL DIIMPORT!');
                            } else {
                                alert('BUKU GAGAL DIIMPORT!');
                                alert(msg);
                            }
                            location.reload(true);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                } else {
                    alert('Pilih file terlebih dahulu!');
                }
                $('#buku_imoprtmodal').hide();

            });
        });

        $('#hide_buku_importmodal').click(function() {
            $('#buku_importmodal').hide();
        });
    </script>
@endpush
