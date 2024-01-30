<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });

    $(document).on('click','.showEditModal',function(){
        let id = $(this).attr('id');
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

                    $('#kodesubyek_edit').val(subyek.kodesubyek);
                    $('#namasubyek_edit').val(subyek.namasubyek);
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
