<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .container th,
        .container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .container th {
            background-color: #f2f2f2;
        }

        .qr-code {
            text-align: center;
        }

        .image-container {
            text-align: center;
            margin: 20px 0;
        }

        .contact-details {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <table class="container">
        <tr>
            <th colspan="2">
                <h2 style="font-weight: 700;">tiket To Do</h2>
                <h5 style="color: #11009E;">Order ID : {{$invoice->id}}</h5>
            </th>
            <th>
                <img src="{{asset('images/logo.png')}}" alt="" style="max-width: 40px;">
                <h2 style="font-weight: 700; display: inline;">POSARA</h2>
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <h3 style="font-weight: 900;">{{$invoice->event->name}}</h3>
                <p style="color: gray;">{{$invoice->detail['type']}}</p>
                <p style="color: gray;">{{$invoice->event->location}}</p>
                <h1 style="font-weight: bold; color: #11009E;">IDR {{ number_format($invoice->price - 500 - $invoice->last_three_value, 2, ',', '.')}}</h1>
                <p style="color: gray;">Date of issue: {{date("d F Y", strtotime($invoice->created_at))}}</p>
            </td>
            <td>
                <div class="qr-code">
                    <h3 style="text-align: center; color: gray; margin-bottom: 0%;">Ticket</h3>
                    <div style="text-align: center; color: gray; margin-bottom: 0%;">Quantity : {{$invoice->detail['quantity']}}</div>
                    <img src="{{$qrCodePath}}" alt="QR Code" style="max-height: 80px;">
                    <div style="padding: 10px; background-color: #11009E; text-align: center; color: white; font-weight: 700; border-radius: 1vh; margin-top: 1vh;">
                        Free seating
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: rgba(109, 185, 239, 0.1); text-align: center; color: #3C486B;">
                <p>Selected Date {{date("D, d M Y", strtotime($invoice->event->date))}}</p>
                <p>No reservation needed</p>
                <p>Refund not allowed</p>
            </td>
        </tr>
    </table>

    <div class="image-container">
        <img src="{{ $imagePath }}" alt="Event Image" style="max-height: 300px;">
    </div>

    <div class="contact-details">
        <p style="font-weight: 800;">Contact Details</p>
        <div>
            <div style="width: 40vh; color: gray; display: inline-block;">
                <p>Nama Pemilik</p>
            </div>
            <div style="display: inline-block;">
                <p>{{ $invoice->nama_pemilik }}</p>
            </div>
        </div>
        <div>
            <div style="width: 40vh; color: gray; display: inline-block;">
                <p>Email</p>
            </div>
            <div style="display: inline-block;">
                <p>{{ $invoice->detail['email'] }}</p>
            </div>
        </div>
        <div>
            <div style="width: 40vh; color: gray; display: inline-block;">
                <p>Phone Number</p>
            </div>
            <div style="display: inline-block;">
                <p>{{ $invoice->detail['phone'] }}</p>
            </div>
        </div>
    </div>

</body>

</html>