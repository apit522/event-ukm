@extends('welcome')

@section('content')

<div class="card">
    <h1>Checkout</h1>
    <h2>Event id :{{ $event->event->id }}</h2>
    <h2>Event name :{{ $event->event->name }} ({{$event->event_price->variant}})</h2>
    <p>Location : {{ $event->event->location }}</p>
    <p>Event mulai: {{ \Carbon\Carbon::parse($event->event->date)->format('l d F, Y') }}</p>
    <p>waktu: {{ \Carbon\Carbon::parse($event->event->date)->format('h:i A') }}</p>

    <p>price : {{ $event->price}}</p>
    <p>admin price : {{$adminPrice = 5000}}</p>
</div>

<!-- resources/views/form/checkout.blade.php -->

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
</script>
@endsection