<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });

    $(document).on('click','.showEditModal',function(){
        let id = $(this).attr('id');
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

                    $('#kodebahasa_edit').val(bahasa.kodebahasa);
                    $('#namabahasa_edit').val(bahasa.namabahasa);
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
