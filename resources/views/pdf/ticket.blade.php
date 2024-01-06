<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 16px;
            margin-bottom: 8px;
        }

        img {
            margin-top: 20px;
            max-width: 100%;
        }
    </style>
</head>

<body>
    <h1>Tiket {{ $invoice->event->name }}</h1>
    <p>Nama Pemilik: {{ $invoice->nama_pemilik }}</p>
    <p>Quantity: {{ $invoice->detail['quantity'] }}</p>
    {{$imagePath}}
    <!-- Tambahkan informasi tiket lainnya -->
    <br>
    <br>
    <!-- Tampilkan QR code -->
    <img src="{{ $qrCodePath }}" alt="QR Code" width="150">

    <!-- Tampilkan gambar -->
    <img src="{{ $imagePath }}" alt="Event Image" width="200">
</body>

</html>