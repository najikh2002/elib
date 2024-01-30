<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });

    $(document).on('click','.showEditModal',function(){
        let id = $(this).attr('id');
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

                    $('#kodepenerbit_edit').val(penerbit.kodepenerbit);
                    $('#namapenerbit_edit').val(penerbit.namapenerbit);
                    $('#alamatpenerbit_edit').val(penerbit.alamatpenerbit);
                    $('#kota_edit').val(penerbit.kota);
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
