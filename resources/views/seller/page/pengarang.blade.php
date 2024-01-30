@extends('layouts.seller')

@section('content-seller')
    @include('components.pengarang.form-add')
    @include('components.pengarang.form-edit')

    <div class="py-6 px-3 w-full">
        <button class="text-[20px] text-slate-500 font-bold" id="show_pengarang_addmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
        <h3 class="text-gray-600 font-semibold py-3">Pengarang</h3>
        <div>
            <table id="pengarang_table" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">#</th>
                        <th class="py-2 px-4 border-b text-start">Nama</th>
                        <th class="py-2 px-4 border-b text-start">Tempat Lahir</th>
                        <th class="py-2 px-4 border-b text-start">Tanggal Lahir</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengarangs as $pengarang)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $pengarang->kodepengarang }}</td>
                        <td class="py-2 px-4 border-b">{{ $pengarang->namapengarang }}</td>
                        <td class="py-2 px-4 border-b">{{ $pengarang->tempatlhr }}</td>
                        <td class="py-2 px-4 border-b">{{ $pengarang->tanggallhr }}</td>
                        <td class="">
                            <div class="flex gap-2">
                                <button id="{{ $pengarang->kodepengarang }}" class="show_pengarang_editmodal bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <form method="POST" action="/seller/pengarang/{{ $pengarang->kodepengarang }}">
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
        $('#pengarang_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );

    $('.show_pengarang_editmodal').click(function () {
        $('#form_editpengarang')[0].reset();
        $('#pengarang_editmodal').show();
    });

    $(document).on('click', '#hide_edit', () => {
        $('#pengarang_editmodal').hide();
    })

    $(document).on('click', '#show_pengarang_addmodal', () => {
        $('#pengarang_form')[0].reset();
        $('#pengarang_addmodal').show();
    });

    $(document).on('click', '#hide_pengarang_addmodal', () => {
        $('#pengarang_addmodal').hide();
    });

</script>
@endpush
