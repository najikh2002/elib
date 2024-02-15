<div id="epp_modal" class="fixed h-screen w-screen bg-black/30 hidden justify-center items-start z-30">
    <div class="container flex flex-col justify-center items-center bg-white relative h-[400px] rounded-md mt-12 px-6 mx-auto" id="hide_epp_modal">
        <button class="text-white flex h-6 w-6 justify-center items-center bg-black absolute top-2 right-2 rounded-full" id="hide_epp_modal"><i class="fa-solid fa-xmark"></i></button>
        <div class="relative" id="profile_form">
            @if ($anggota->foto)
            @php
                $fotoPath = str_replace('public/', '', $anggota->foto);
                $assetPath = asset("storage/{$fotoPath}");
            @endphp
                <img src="{{ $assetPath }}" alt="" class="w-[150px] h-[150px] object-cover rounded-full" id="img_profile">
            @else
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="w-[150px] h-[150px] object-cover rounded-full" id="img_profile">
            @endif
            <label for="input_img_profile" class="cursor-pointer text-white bg-black h-8 w-8 flex justify-center items-center rounded-full absolute bottom-2 right-2" id="set">
                <i class="fa-solid fa-gear"></i>
                <input type="file" id="input_img_profile" class="hidden" onchange="updateFotoPreview(this)">
            </label>
        </div>
        <button type="button" id="edit_foto" class="mt-12 text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-800 dark:focus:ring-gray-900">Perbarui</button>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            let imgPrev = $('#img_profile').attr('src');

            $("#edit_foto").click(function(e) {
                e.preventDefault();
                console.log('klik');

                let token = $("meta[name='csrf-token']").attr("content");
                let input_img_profile = $("#input_img_profile")[0].files[0];

                let formData = new FormData();
                formData.append('_token', token);
                formData.append('input_img_profile', input_img_profile);

                $.ajax({
                    url: `/profile-photo`,
                    method: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                        location.reload(true);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });

            function resetFotoPreview() {
                $('#img_profile').attr('src', imgPrev);
                $("#input_img_profile").val('');
            }

            $("#show_epp_modal").click(() => {
                $("#epp_modal").show();
            });

            $("#hide_epp_modal").click(() => {
                $("#epp_modal").hide();
                resetFotoPreview();
            });

            $("#set").click(function (e) {
                e.stopPropagation();
            });
        });
    </script>

    <script>
         function updateFotoPreview(input) {
                var currentFotoContainer = $('#profile_form');
                var currentFoto = $('#img_profile');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        currentFoto.attr('src', e.target.result);
                        currentFotoContainer.show();
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    currentFotoContainer.hide();
                }
            }
    </script>
@endpush

