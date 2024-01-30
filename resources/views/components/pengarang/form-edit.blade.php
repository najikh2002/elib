<div id="pengarang_editmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full md:w-[30%]" id="form_editpengarang">

            <div class="flex flex-col w-full gap-3">
                <!-- Nama Pengarang -->
                <div class="mb-4 w-full">
                    <label for="namapengarang_edit" class="block w-full text-gray-600 font-semibold mb-2">Nama Pengarang</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namapengarang_edit" name="namapengarang_edit" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-4">
                    <label for="tempatlhr_edit" class="block text-gray-600 font-semibold mb-2">Tempat Lahir</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tempatlhr_edit" name="tempatlhr_edit">
                </div>

                <!-- TTL -->
                <div class="mb-4">
                    <label for="tanggallhr_edit" class="block text-gray-600 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="tanggallhr_edit" name="tanggallhr_edit">
                </div>

            </div>

            <div class="flex justify-start items-center gap-3">
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Update
                </button>
                <button type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800" id="hide_edit">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).on('click','.show_pengarang_editmodal',function(){
            let id = $(this).attr('id');

            $('#form_editpengarang').submit(function (e) {
                        e.preventDefault();

                        let token   = $("meta[name='csrf-token']").attr("content");
                        var formData = new FormData(this);

                        formData.append("_token", token);
                        formData.append("kodepengarang", id);
                        formData.append("namapengarang", $('#namapengarang_edit').val());
                        formData.append("tempatlhr", $('#tempatlhr_edit').val());
                        formData.append("tanggallhr", $('#tanggallhr_edit').val());


                        $.ajax({
                            url: '/seller/updatepengarang',
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
                                    alert('PENGARANG BERHASIL DIUPDATEt!');
                                } else {
                                    alert('PENGARANG GAGAL DIUPDATE!');
                                }
                                $('#pengarang_editmodal').hide();
                                $('#pengarang_editmodal').fadeOut(500, function() {
                                    location.reload(true);
                                });
                            },
                            error: function (error) {
                                console.log(error);

                            }
                        });
            });

            $.ajax({
                url:`/seller/editpengarang/${id}`,
                method:'GET',
                dataType:'JSON',
                success:function(response){
                    res = response;
                },
                complete:function(){
                    status = res.status;
                    data = res.data;
                    msg = res.msg;

                    if(status){
                        $('#form_editpengarang')[0].reset();
                        pengarang = data;

                        $('#namapengarang_edit').val(pengarang.namapengarang);
                        $('#tempatlhr_edit').val(pengarang.tempatlhr);
                        $('#tanggallhr_edit').val(pengarang.tanggallhr);

                    }else{
                        alert(msg);
                    }


                }
            });
        });
    </script>
@endpush
