@extends('layouts.seller')

@section('content-seller')
    @include('components.penerbit.form-add')
    @include('components.penerbit.form-edit')

    <div class="py-6 px-3 w-full">
        <button class="text-[20px] text-slate-500 font-bold" id="show_penerbit_addmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
        <h3 class="text-gray-600 font-semibold py-3">Penerbit</h3>
        <div>
            <table id="penerbit_table" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">#</th>
                        <th class="py-2 px-4 border-b text-start">Nama</th>
                        <th class="py-2 px-4 border-b text-start">Alamat</th>
                        <th class="py-2 px-4 border-b text-start">Kota</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penerbits as $penerbit)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $penerbit->kodepenerbit }}</td>
                        <td class="py-2 px-4 border-b">{{ $penerbit->namapenerbit }}</td>
                        <td class="py-2 px-4 border-b">{{ $penerbit->alamatpenerbit }}</td>
                        <td class="py-2 px-4 border-b">{{ $penerbit->kota }}</td>
                        <td class="">
                            <div class="flex gap-2">
                                <button id="{{ $penerbit->kodepenerbit }}" class="show_penerbit_editmodal bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <form method="POST" action="/seller/penerbit/{{ $penerbit->kodepenerbit }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script-seller')
<script>
    $(document).ready(function() {
        $('#penerbit_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

    $(document).on('click', '#hide_edit', () => {
        $('#editmodal').hide();
    })

    $('.show_penerbit_editmodal').click(function(){
        $('#penerbit_editmodal').show();
    });

    $(document).on('click', '#show_penerbit_addmodal', () => {
        $('#penerbit_addform')[0].reset();
        $('#penerbit_addmodal').show();
    });

</script>
@endpush
