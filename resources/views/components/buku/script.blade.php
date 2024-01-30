<script>
    // FORM SUMBER PEROLEHAN HANDLER
    $('#sp_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/seller/buatsumberperolehan',
            type: 'post',
            data:$('#sp_form').serialize(),
            success:function(){
                // Whatever you want to do after the form is successfully submitted
                alert("Sumber Perolehan Berhasil ditambahkan!");
                $('#sp_addmodal').hide();
            }
        });
    });



    // SP MODAL HANDLER
    $(document).on('click', '#show_spaddmodal', () => {
        $('#sp_addmodal').show();
    });

    $(document).on('click', '#hide_spaddmodal', () => {
        $('#sp_addmodal').hide();
    });

    var spInput = document.getElementById('sp_input');
    var spList = document.getElementById('sp_list');

    spInput.addEventListener('input', function() {
        var inputValue = spInput.value.toLowerCase() || 'unjaya';
        spList.innerHTML = '';

        var endpoint = '/cari/sumberperolehan/' + inputValue;

        $.ajax({
            url: endpoint,
            method: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var status = response.status;
                var data = response.data;
                var msg = response.msg;

                if (status) {
                    var sumberperolehan = data;

                    sumberperolehan.forEach(function(item) {

                        var option = document.createElement('option');
                        option.value = item.kodesumberperolehan;
                        option.text = item.namasumberperolehan;
                        spList.appendChild(option);

                    });

                } else {
                    alert(msg);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // PENGARANG MODAL HANDLER
    function updateSelectedOptionText(value) {
        var datalist = document.getElementById("sp_list");
        var selectedOption = datalist.querySelector("option[value='" + value + "']");
        if (selectedOption) {
            document.getElementById("pengarang_input").setAttribute("data-selected-text", selectedOption.text);
        } else {
            document.getElementById("pengarang_input").setAttribute("data-selected-text", "");
        }
    }

    $(document).on('click', '#show_pengarangaddmodal', () => {
        $('#pengarang_addmodal').show();
    });

    $(document).on('click', '#hide_pengarangaddmodal', () => {
        $('#pengarang_addmodal').hide();
    });

    var pengarangInput = document.getElementById('pengarang_input');
    var pengarangList = document.getElementById('pengarang_list');

    pengarangInput.addEventListener('input', function() {
        var inputValue = pengarangInput.value.toLowerCase() || 'unjaya';
        pengarangList.innerHTML = '';

        var endpoint = '/cari/pengarang/' + inputValue;

        $.ajax({
            url: endpoint,
            method: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var status = response.status;
                var data = response.data;
                var msg = response.msg;

                if (status) {
                    var pengarang = data;

                    pengarang.forEach(function(item) {
                        var option = document.createElement('option');
                        option.value = item.kodepengarang;
                        option.text = item.namapengarang;
                        pengarangList.appendChild(option);
                    });

                } else {
                    alert(msg);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error ke konsol
            }
        });
    });

    // PENERBIT MODAL HANDLER
    $(document).on('click', '#show_penerbitaddmodal', () => {
        $('#penerbit_addmodal').show();
    });

    $(document).on('click', '#hide_penerbitaddmodal', () => {
        $('#penerbit_addmodal').hide();
    });

    var penerbitInput = document.getElementById('penerbit_input');
    var penerbitList = document.getElementById('penerbit_list');

    penerbitInput.addEventListener('input', function() {
        var inputValue = penerbitInput.value.toLowerCase() || 'unjaya';
        penerbitList.innerHTML = '';

        var endpoint = '/cari/penerbit/' + inputValue;

        $.ajax({
            url: endpoint,
            method: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var status = response.status;
                var data = response.data;
                var msg = response.msg;

                if (status) {
                    var penerbit = data;

                    penerbit.forEach(function(item) {
                        var option = document.createElement('option');
                        option.value = item.kodepenerbit;
                        option.text = item.namapenerbit;
                        penerbitList.appendChild(option);
                    });
                } else {
                    alert(msg);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // JENIS BUKU MODAL HANDLER
    $(document).on('click', '#show_penerbitaddmodal', () => {
        $('#penerbit_addmodal').show();
    });

    $(document).on('click', '#hide_penerbitaddmodal', () => {
        $('#penerbit_addmodal').hide();
    });

    var penerbitInput = document.getElementById('penerbit_input');
    var penerbitList = document.getElementById('penerbit_list');

    penerbitInput.addEventListener('input', function() {
        var inputValue = penerbitInput.value.toLowerCase() || 'unjaya';
        penerbitList.innerHTML = '';

        var endpoint = '/cari/penerbit/' + inputValue;

        $.ajax({
            url: endpoint,
            method: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var status = response.status;
                var data = response.data;
                var msg = response.msg;

                if (status) {
                    var penerbit = data;

                    penerbit.forEach(function(item) {
                        var option = document.createElement('option');
                        option.value = item.kodepenerbit;
                        option.text = item.namapenerbit;
                        penerbitList.appendChild(option);
                    });
                } else {
                    alert(msg);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

</script>
