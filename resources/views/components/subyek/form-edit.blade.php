<div id="subyek_editmodal" class="w-screen h-full z-30 bg-black/30 hidden fixed justify-center items-center p-12">
    <div class="flex justify-center items-center h-[80%]">
        <form class="bg-white p-6 rounded-md shadow-md w-full md:w-[50%]" id="subyek_editform">
            <!-- Input Kode Jenis Buku -->
            <div class="mb-4">
                <label for="namasubyek_edit" class="block text-gray-600 font-semibold mb-2">Nama Subjek</label>
                <input type="text" class="border-[1.3px] border-slate-400 rounded-md p-2 w-full" id="namasubyek_edit" name="namasubyek_edit" required>
            </div>

            <div class="flex justify-start items-center gap-3">
                <button class="bg-blue-500 text-white w-[150px] py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Update
                </button>
                <button type="button" class="bg-red-500 text-white w-[150px] py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-blue active:bg-red-800" id="hide_subyek_editmodal">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('script-seller')
    <script>
        $(document).on('click','.show_subyek_editmodal',function(){
            let id = $(this).attr('id');

            $('#subyek_editform').submit(function (e) {
                e.preventDefault();

                let token   = $("meta[name='csrf-token']").attr("content");
                var formData = new FormData(this);

                formData.append("_token", token);
                formData.append("kodesubyek_edit", id);
                formData.append("namasubyek_edit", $('#namasubyek_edit').val());

                $.ajax({
                    url: '/seller/updatesubyek',
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
                            alert('SUBJEK BERHASIL DIUPDATEt!');
                        } else {
                            alert('SUBJEK GAGAL DIUPDATE!');
                        }
                        $('#subyek_editmodal').hide();
                        $('#subyek_editmodal').fadeOut(500, function() {
                            location.reload(true);
                        });
                    },
                    error: function (error) {
                        console.log(error);

                    }
                });
            });

            $.ajax({
                url:`/seller/editsubyek/${id}`,
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
                        subyek = data;

                        $('#namasubyek_edit').val(subyek.namasubyek);
                        $('#editmodal').show();

                    }else{
                        alert(msg);
                    }
                }
            });
        });

        $('#hide_subyek_editmodal').click(function() {
            $('#subyek_editmodal').hide();
        });
    </script>
@endpush
