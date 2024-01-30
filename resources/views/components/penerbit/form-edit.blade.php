<div id="penerbit_editmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full md:w-[80%]" id="penerbit_editform">

            <div class="flex flex-col w-full gap-3">
                <!-- Nama Penerbit -->
                <div class="mb-4">
                    <label for="namapenerbit" class="block text-gray-600 font-semibold mb-2">Nama Penerbit</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namapenerbit_edit" name="namapenerbit" required>
                </div>

                <!-- Alamat Penerbit -->
                <div class="mb-4">
                    <label for="alamatpenerbit" class="block text-gray-600 font-semibold mb-2">Alamat Penerbit</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="alamatpenerbit_edit" name="alamatpenerbit">
                </div>

                <!-- Kota Penerbit -->
                <div class="mb-4">
                    <label for="kota" class="block text-gray-600 font-semibold mb-2">Kota Penerbit</label>
                    <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="kota_edit" name="kota">
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Update
                </button>
                <button id="hide_penerbit_editmodal" type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).on('click','.show_penerbit_editmodal',function(){
            let id = $(this).attr('id');

            $('#penerbit_editform').submit(function (e) {
                e.preventDefault();

                let token   = $("meta[name='csrf-token']").attr("content");
                var formData = new FormData(this);

                formData.append("_token", token);
                formData.append("kodepenerbit_edit", id);
                formData.append("namapenerbit_edit", $('#namapenerbit_edit').val());
                formData.append("alamatpenerbit_edit", $('#alamatpenerbit_edit').val());
                formData.append("kota_edit", $('#kota_edit').val());

                $.ajax({
                    url: '/seller/updatepenerbit',
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
                            alert('PENERBIT BERHASIL DIUPDATEt!');
                        } else {
                            alert('PENERBIT GAGAL DIUPDATE!');
                        }
                        $('#penerbit_editmodal').hide();
                        $('#penerbit_editmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
                    },
                    error: function (error) {
                        console.log(error);

                    }
                });
            });

            $.ajax({
                url:`/seller/editpenerbit/${id}`,
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
                        penerbit = data;

                        $('#namapenerbit_edit').val(penerbit.namapenerbit);
                        $('#alamatpenerbit_edit').val(penerbit.alamatpenerbit);
                        $('#kota_edit').val(penerbit.kota);

                    }else{
                        alert(msg);
                    }
                }
            });
        });

        $('#hide_penerbit_editmodal').click(function() {
            $('#penerbit_editmodal').hide();
        });
    </script>
@endpush
