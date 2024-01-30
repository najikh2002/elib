@extends('layouts.seller')

@section('content-seller')
    @include('components.jenisbuku.form-add')
    @include('components.jenisbuku.form-edit')

    <div class="py-6 px-3 w-full">
        <button class="text-[20px] text-slate-500 font-bold" id="show_jenisbuku_addmodal"><i class="fa fa-plus" aria-hidden="true"></i></button>
        <h3 class="text-gray-600 font-semibold py-3">Jenis Buku</h3>
        <div>
            <table id="jenisbuku_table" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">#</th>
                        <th class="py-2 px-4 border-b text-start">Nama</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenisbukus as $jenisbuku)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $jenisbuku->kodejenisbuku }}</td>
                        <td class="py-2 px-4 border-b">{{ $jenisbuku->namajenisbuku }}</td>
                        <td class="">
                            <div class="flex gap-2">
                                <button id="{{ $jenisbuku->kodejenisbuku }}" class="show_jenisbuku_editmodal bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                <form method="POST" action="/seller/jenisbuku/{{ $jenisbuku->kodejenisbuku }}">
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
        $('#jenisbuku_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

    $(document).on('click', '#hide_edit', () => {
        $('#editmodal').hide();
    })

    $('.show_jenisbuku_editmodal').click(function(){
        $('#jenisbuku_editform')[0].reset();
        $('#jenisbuku_editmodal').show();
    });

    $(document).on('click', '#show_jenisbuku_addmodal', () => {
        $('#jenisbuku_addmodal').show();
    });

    $(document).on('click', '#hideAddModal', () => {
        $('#jenisbuku_addmodal').hide();
    });

</script>
@endpush
