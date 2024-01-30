@extends('layouts.seller')

@section('content-seller')
@include('components.subyek.form-add')
@include('components.subyek.form-edit')

<!-- Kode Jenis Buku -->
<div class="py-6 px-3 w-full">
    <button class="text-[20px] text-slate-500 font-bold" id="showAddModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
    <h3 class="text-gray-600 font-semibold py-3">Subyek</h3>
    <div>
        <table id="subyek_table" class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-start">#</th>
                    <th class="py-2 px-4 border-b text-start">Nama</th>
                    <th class="py-2 px-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subyeks as $subyek)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $subyek->kodesubyek }}</td>
                    <td class="py-2 px-4 border-b">{{ $subyek->namasubyek }}</td>
                    <td class="">
                        <div class="flex gap-2">
                            <button id="{{ $subyek->kodesubyek }}" class="show_subyek_editmodal bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </button>
                            <form method="POST" action="/seller/subyek/{{ $subyek->kodesubyek }}">
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
        $('#subyek_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

    $(document).on('click', '#hide_edit', () => {
        $('#editmodal').hide();
    })

    $('.show_subyek_editmodal').click(function(){
        $('#subyek_editform')[0].reset();
        $('#subyek_editmodal').show();
    });

    $(document).on('click', '#showAddModal', () => {
        $('#subyek_addmodal').show();
    });

    $(document).on('click', '#hideAddModal', () => {
        $('#subyek_addmodal').hide();
    });

</script>
@endpush

