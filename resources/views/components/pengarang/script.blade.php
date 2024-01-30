<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });

    $(document).on('click','.showEditModal',function(){
        let id = $(this).attr('id');
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
                    pengarang = data;

                    $('#kodepengarang_edit').val(pengarang.kodepengarang);
                    $('#namapengarang_edit').val(pengarang.namapengarang);
                    $('#tempatlhr_edit').val(pengarang.tempatlhr);
                    $('#tanggallhr_edit').val(pengarang.tanggallhr);

                    $('#editmodal').show();

                }else{
                    alert(msg);
                }
            }
        });
    });

    $(document).on('click', '#hide_edit', () => {
        $('#editmodal').hide();
    })

    $(document).on('click', '#showAddModal', () => {
        $('#addmodal').show();
    });

    $(document).on('click', '#hideAddModal', () => {
        $('#addmodal').hide();
    });

</script>
