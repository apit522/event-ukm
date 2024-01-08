@extends('master')

@section('content')
@if($newPrice != 0)
<div class="card p-6 bg-white shadow-md rounded-md max-w-xl mx-auto text-center py-4 my-4">
    <h1 class="text-2xl font-bold mb-4 text-blue-900">Checkout</h1>
    <div class="flex flex-row items-center justify-between mb-4 bg-pink-100 p-4 text-center w-full">
        <h2 class="text-xl font-bold mb-4 text-red-500" style="margin: auto;">Pay before {{\Carbon\Carbon::parse($nextDay)->format('l, d F Y H:i')}} WIB</h2>
    </div>

    <h2 class="text-lg font-bold mb-4 text-blue-900">Transfer Bank</h2>
    <div class="flex flex-col justify-between mb-4  border-t border-gray-300 pt-4 text-left">
        <div class="flex flex-row justify-between mb-4">
            <h2 class="text-l font-bold" style="margin-right: auto;">Total</h2>
            <h2 class="text-l font-bold" style="margin-left: auto;">IDR {{ number_format($newPrice, 0, ',', '.') }}</h2>
        </div>
        <div class="flex flex-row justify-between mb-4">
            <div class="flex flex-col" style="margin-right: auto;">
                <h2 class="text-l font-bold">Account Number</h2>
                <h2 class="text-l">PT POSARA Indonesia</h2>
            </div>

            <h2 class="text-l font-bold" style="margin-left: auto;">1560021678836</h2>
        </div>
    </div>
    <img src="https://tes.susatyo.com/storage/categories/Important.png" alt="Image" class="w-35 h-auto object-cover mb-8" style="margin: auto;">

    <a href="/" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full w-full mt-12 mb-4">Back to Home</a>
</div>
@else
<div class="card p-6 bg-white shadow-md rounded-md max-w-xl mx-auto text-center py-4 my-4">

    <img src="https://tes.susatyo.com/storage/categories/confirm.png" alt="Image" class="w-42 h-auto object-cover mb-8">


    <a href="/" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full w-full mt-4 mb-4">Back to Home</a>
</div>
@endif
@endsection
