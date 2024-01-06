@extends('welcome')

@section('content')
<div class="card p-6 bg-white shadow-md rounded-md max-w-xl mx-auto text-center py-4 my-4">

    <h1 class="text-2xl font-bold mb-4 text-blue-900">Checkout</h1>

    <h2 class="text-lg font-bold mb-4 text-blue-900 part1">Booking Info</h2>
    <h2 class="text-lg font-bold mb-4 text-blue-900 part2" style="display: none;">Contact Data</h2>

    <div class="flex flex-row items-center justify-between mb-4 border-t border-gray-300 pt-4 part1">
        <div class="text-left">
            <h2 class="text-lg font-bold mb-2">Event Name</h2>
            <h3>{{ $event->event->name }}</h3>
            <h2 class="text-lg font-bold mb-2">Location</h2>
            <h3>{{ $event->event->location }}</h3>
        </div>
        <div class="text-left">
            <h2 class="text-lg font-bold mb-2">Start - End Date</h2>
            <h3>{{ \Carbon\Carbon::parse($event->start_date)->format('l d F, Y') }} -</h3>
            <h3>{{ \Carbon\Carbon::parse($event->due_to)->format('l d F, Y') }}</h3>
            <h2 class="text-lg font-bold mb-2">Timings</h2>
            <h3>{{ \Carbon\Carbon::parse($event->event->date)->format('h:i A') }} (WIB)</h3>
        </div>
    </div>

    <h2 class="text-lg font-bold mb-4 text-blue-900 part1">Tickets</h2>

    <form action="{{ url('/form/checkout/' . $event->id) }}" method="post" class="mt-4">
        @csrf
        <div style="display: none;" class="flex flex-col mb-4  border-t border-gray-300 pt-4 text-left part2">
            <div class="flex flex-row justify-between items-center mb-4 part2" style="display: none;">
                <div>

                    <h3>First Name</h3>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="p-2 border rounded-md bg-white-100 shadow-md" required>
                </div>
                <div>
                    <h3>Last Name</h3>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="p-2 border rounded-md bg-white-100 shadow-md" required>
                </div>
            </div>
            <div class="flex flex-col part2" style="display:none;">
                <div class="mb-4">
                    <h3>Email</h3>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="p-2 border rounded-md bg-white-100 shadow-md w-full" required>
                </div>
                <div>
                    <h3>Phone</h3>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="p-2 border rounded-md bg-white-100 shadow-md w-full" required>
                </div>
            </div>

        </div>
        <div class="flex flex-row justify-between items-center mb-4  border-t border-gray-300 pt-4 part1">
            <div class="text-left part1">
                <h2 class="text-lg font-bold mb-2">{{$event->event_price->variant}}</h2>
                <h3>IDR {{ number_format($event->price, 0, ',', '.') }}</h3>
            </div>

            <div class="part1">

                <select name="quantity" id="quantity" required onchange="calculatePrice()" class="mt-1 block p-2 border rounded-md part1">
                    @if(!$event->max_purchase)
                    @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
                @error('quantity')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                @else
                @for ($i = 1; $i <= $event->max_purchase; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    </select>
                    @error('quantity')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    @endif
            </div>

            <h3 id="harga" class="part1">IDR {{ number_format($event->price, 0, ',', '.') }}</h3>
        </div>

        <h2 class="text-lg font-bold mb-4 text-blue-900 part1">Shopping Cart</h2>

        <div class="flex flex-row justify-between items-center mb-4  border-t border-gray-300 pt-4 text-left part1">
            <div>
                <h2 class="text-l font-bold">Biaya Admin</h2>
                <h2 class="text-xl font-bold">Total</h2>
            </div>
            <div>
                @if ($event->price == 0)
                <?php $adminPrice = 0; ?>
                @else
                <?php $adminPrice = 5000; ?>
                @endif

                <h3>IDR {{ number_format($adminPrice, 0, ',', '.') }}</h3>
                <h3 id="total_harga">IDR {{ number_format($adminPrice+$event->price, 0, ',', '.') }}</h3>

                <input type="number" name="price" id="price" value="{{ $event->price + $adminPrice }}" readonly class="p-2 border rounded-md bg-gray-100" hidden>
                @error('price')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @if($event->price==0)
        <div class="bg-gray-900 flex flex-col items-center mb-4 part2 p-4 w-48 rounded shadow-md mx-auto" style="display:none;">
            <img src="https://tes.susatyo.com/storage/categories/free.png" alt="Image" class="w-28 h-auto object-cover rounded">
        </div>
        @else
        <div class="bg-gray-900 flex flex-col items-center mb-4 part2 p-4 w-48 rounded shadow-md mx-auto" style="display:none;">
            <img src="https://tes.susatyo.com/storage/categories/mandiri.png" alt="Image" class="w-28 h-auto object-cover mb-4 rounded">
            <p class="text-white">Transfer Bank (Manual)</p>
        </div>
        @endif

        <button class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full w-full part1" onclick="toggleClasses()">
            Continue
        </button>
        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full w-full mt-4 part2" style="display: none;">
            Continue
        </button>
    </form>

</div>

<script>
    function calculatePrice() {
        var quantity = parseInt(document.getElementById('quantity').value) || 0;
        var eventPrice = parseFloat("{{ $event->price }}") || 0;
        var adminPrice = parseFloat("{{ $adminPrice }}") || 0;
        var totalPrice = quantity * eventPrice + adminPrice;
        var harga = quantity * eventPrice;
        document.getElementById('price').value = totalPrice;
        document.getElementById("harga").innerHTML = 'IDR ' + harga.toLocaleString();
        document.getElementById("total_harga").innerHTML = 'IDR ' + totalPrice.toLocaleString();
    }

    function toggleClasses() {
        // Mengubah elemen dengan class 'part1' menjadi display: none;
        var elementsPart1 = document.getElementsByClassName('part1');
        for (var i = 0; i < elementsPart1.length; i++) {
            elementsPart1[i].style.display = 'none';
        }

        // Menghapus display: none; dari elemen dengan class 'part2'
        var elementsPart2 = document.getElementsByClassName('part2');
        for (var i = 0; i < elementsPart2.length; i++) {
            elementsPart2[i].style.display = '';
        }
    }
</script>

<!-- <div class="card">
    <h1>Checkout</h1>
    <h2>Event id :{{ $event->event->id }}</h2>
    <h2>Event name :{{ $event->event->name }} ({{$event->event_price->variant}})</h2>
    <p>Location : {{ $event->event->location }}</p>
    <p>Event mulai: {{ \Carbon\Carbon::parse($event->event->date)->format('l d F, Y') }}</p>
    <p>waktu: {{ \Carbon\Carbon::parse($event->event->date)->format('h:i A') }}</p>
    <p>waktu: {{ $event->max_purchase}}</p>

    <p>price : {{ $event->price}}</p>
    <p>admin price : {{$adminPrice = 5000}}</p>
</div>


<form action="{{ url('/form/checkout/' . $event->id) }}" method="post">
    @csrf

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
    @error('first_name')
    <div class="error">{{ $message }}</div>
    @enderror

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
    @error('last_name')
    <div class="error">{{ $message }}</div>
    @enderror

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    @error('email')
    <div class="error">{{ $message }}</div>
    @enderror

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required onchange="calculatePrice()">
    @error('quantity')
    <div class="error">{{ $message }}</div>
    @enderror

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" value="{{ old('price') }}" required>
    @error('price')
    <div class="error">{{ $message }}</div>
    @enderror

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
    @error('phone')
    <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit">Submit</button>
</form>


<script>
    function calculatePrice() {
        var quantity = parseInt(document.getElementById('quantity').value) || 0;
        var eventPrice = parseFloat("{{ $event->price }}") || 0;
        var adminPrice = parseFloat("{{ $adminPrice }}") || 0;
        var totalPrice = quantity * eventPrice + adminPrice;
        document.getElementById('price').value = totalPrice;
    }
</script> -->
@endsection