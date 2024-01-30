@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto flex flex-col justify-center items-center h-[630px]">
	<div
		class="bg-white shadow-md border border-gray-200 rounded-lg w-[90%] md:w-[60%] p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
		<form class="space-y-6" action="login" method="POST">
            @csrf

			<h3 class="text-xl text-center font-medium text-gray-900 dark:text-white">LOGIN</h3>
			<div>
				<x-input-label value="User" for="user" />
                <x-input type="text" name="user" id="user" />
            </div>
				<div>
					<x-input-label value="Password" for="password" />
                    <x-input type="password" name="password" id="password" />
                </div>
					<div class="flex items-start">

                    <button type="submit" class="w-full text-white bg-black hover:opacity-80 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
		</form>
	</div>
</div>
@endsection
