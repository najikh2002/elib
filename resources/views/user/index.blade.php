@extends('layouts.app')

@section('content')
    {{-- header --}}
    <div class="flex w-full h-[250px] bg-black">
        test
    </div>
    {{-- navbar --}}
    @include('components.navbar')
    {{-- content --}}
    <div class="flex flex-col justify-center items-center">
        <div class="flex flex-col gap-3 p-[5%] justify-center items-center">
            <h3 class="text-[28px] md:text-[38px] uppercase font-semibold text-center">welcome to unjaya digital library</h3>
            <p class="text-[14px] md:text-[16px] text-center w-[80%]">Explore over 170M documents from a global community, share information, and find inspiration</p>
        </div>
        <div class="flex items-center justify-center w-full">
            @include('components.searchbar')
        </div>
        <div class="py-4 px-[5%]">
            <div class="max-w-7xl gap-3">
                <div class="flex flex-col gap-3 w-full">
                    @if ($pinjamcount)
                        @include('components.item-pinjam')
                    @else
                        @include('components.item-pinjam-null')
                    @endif
                    @include('components.item')
                </div>
            </div>
        </div>
    </div>
@endsection

