<!-- resources/views/pdf/ticket.blade.php -->

<h1>Tiket {{$invoice->event->name}}</h1>
<p>Nama Pemilik: {{ $invoice->nama_pemilik }}</p>
<!-- Tambahkan informasi tiket lainnya -->
<br>
<br>
<!-- Tampilkan QR code -->
<img src="{{ $qrCodePath }}" alt="QR Code" width="150">

<!-- Tampilkan gambar -->
<img src="{{ $imagePath }}" alt="Event Image" width="200">