<div id="bahasa_editmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form id="bahasa_editform" class="bg-white p-6 rounded-md shadow-md w-full md:w-[30%]">

            <div class="mb-4">
                <label for="namabahasa_edit" class="block text-gray-600 font-semibold mb-2">Nama Bahasa</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namabahasa_edit" name="namabahasa_edit" required>
            </div>

            <div class="flex justify-start items-center gap-3">
                <button type="submit" class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Update
                </button>
                <button type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800" id="hide_bahasa_editmodal">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).on('click','.show_bahasa_editmodal',function(){
            let id = $(this).attr('id');

            $('#bahasa_editform').submit(function (e) {
                e.preventDefault();

                let token   = $("meta[name='csrf-token']").attr("content");
                var formData = new FormData(this);

                formData.append("_token", token);
                formData.append("kodebahasa_edit", id);
                formData.append("namabahasa_edit", $('#namabahasa_edit').val());

                $.ajax({
                    url: '/seller/updatebahasa',
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
                            alert('BAHASA BERHASIL DIUPDATEt!');
                        } else {
                            alert('BAHASA GAGAL DIUPDATE!');
                        }
                        $('#bahasa_editmodal').hide();
                        $('#bahasa_editmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
                    },
                    error: function (error) {
                        console.log(error);

                    }
                });
            });

            $.ajax({
                url:`/seller/editbahasa/${id}`,
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
                        bahasa = data;

                        $('#namabahasa_edit').val(bahasa.namabahasa);
                        $('#bahasa_editmodal').show();

                    }else{
                        alert(msg);
                    }
                }
            });
        });

        $('#hide_bahasa_editmodal').click(function() {
            $('#bahasa_editmodal').hide();
        });
    </script>
@endpush
