<div class="h-full w-full z-50 fixed hidden" id="anggota_importmodal">
    <div class="w-screen h-full z-30 bg-black/30 fixed justify-center items-center p-12">
        <div class="flex justify-center items-center h-[80%]">
            <div class="bg-white p-6 rounded-md shadow-md w-[80%] md:w-[40%]">

                <div class="flex w-full gap-3">
                    <div class="mb-4 w-full">
                        <label for="dataanggota" class="block text-gray-600 font-semibold mb-2">Import Data Anggota</label>
                        <input type="file" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="dataanggota" name="dataanggota" required>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="import_anggota" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        Import
                    </button>
                    <button type="button" id="hide_anggota_importmodal" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script-seller')
    <script>
        // $('#import_anggota').click(function(e) {
        //     e.preventDefault();

        //     let dataanggota = $('#dataanggota').prop('files')[0];
        //     let token   = $("meta[name='csrf-token']").attr("content");


        //     $.ajax({

        //         url: `/import/anggota`,
        //         type: 'POST',
        //         cache: false,
        //         data: {
        //             "dataanggota": dataanggota,
        //             "_token": token
        //         },
        //         success:function(response){
        //             console.log(response);
        //             let res = response;
        //             let status = res.success;

        //             if(status) {
        //                 alert('ANGGOTA BERHASIL DIIMPORT!');
        //             } else {
        //                 alert('ANGGOTA GAGAL DIIMPORT!');
        //             }
        //         },
        //         error:function(error){
        //             console.log(error);
        //         }

        //     });

        //     $('#anggota_imoprtmodal').hide();
        // });

        $(document).ready(function() {
            $('#import_anggota').click(function() {
                let dataanggota = $('#dataanggota').prop('files')[0];

                if (dataanggota) {
                    let formData = new FormData();
                    formData.append('dataanggota', dataanggota);
                    formData.append('_token', $("meta[name='csrf-token']").attr("content"));

                    $.ajax({
                        url: '/import/anggota',
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
                                alert('ANGGOTA BERHASIL DIIMPORT!');
                            } else {
                                alert('ANGGOTA GAGAL DIIMPORT!');
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
                $('#anggota_imoprtmodal').hide();

            });
        });

        $('#hide_anggota_importmodal').click(function() {
            $('#anggota_importmodal').hide();
        });
    </script>
@endpush
