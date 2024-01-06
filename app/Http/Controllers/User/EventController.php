<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\InvoiceEmail;
use App\Mail\TicketEmail;
use App\Models\Event;
use App\Models\EventPresale;
use Intervention\Image\Facades\Image;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    private function generateAndSendTicket($invoiceId)
    {
        set_time_limit(300);
        $invoice = Invoice::findOrFail($invoiceId);

        // Generate QR code
        $filePath = 'public/tickets/qrcode_' . $invoiceId . '.png';

        // Ensure the directory exists, create it if necessary
        if (!Storage::exists(dirname($filePath))) {
            Storage::makeDirectory(dirname($filePath));
        }
        $qrCodePath = storage_path('app/public/tickets/qrcode_' . $invoiceId . '.png');
        QrCode::size(300)->generate($invoiceId, $qrCodePath);

        // Download image using Guzzle
        $imagePath = $invoice->event->post->cover_image;

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', compact('invoice', 'qrCodePath', 'imagePath'));
        // $pdf = App::make('dompdf.wrapper');

        // // Load HTML ke dalam PDF
        // $pdf->loadHTML('
        //     <!DOCTYPE html>
        //     <html>

        //     <head>
        //         <style>
        //             body {
        //                 font-family: "Arial", sans-serif;
        //             }

        //             h1 {
        //                 color: #333;
        //                 font-size: 24px;
        //                 margin-bottom: 10px;
        //             }

        //             p {
        //                 color: #555;
        //                 font-size: 16px;
        //                 margin-bottom: 8px;
        //             }

        //             img {
        //                 margin-top: 20px;
        //                 max-width: 100%;
        //             }
        //         </style>
        //     </head>

        //     <body>
        //         <h1>Tiket {{ $invoice->event->name }}</h1>
        //         <p>Nama Pemilik: {{ $invoice->nama_pemilik }}</p>
        //         <!-- Tambahkan informasi tiket lainnya -->
        //         <br>
        //         <br>
        //         <!-- Tampilkan QR code -->
        //         <img src="' . $qrCodePath . '" alt="QR Code" width="150">

        //         <!-- Tampilkan gambar -->
        //         <img src="' . $imagePath . '" alt="Event Image" width="200">
        //     </body>

        //     </html>
        // ');


        // Save PDF to storage (optional)
        $pdfPath = storage_path('app/public/tickets/ticket_' . $invoiceId . '.pdf');
        $pdf->save($pdfPath);

        // Send email with PDF attachment
        Mail::to($invoice->detail['email'])->send(new TicketEmail($invoice, $pdfPath));
        return response()->json(['message' => 'Ticket sent successfully']);
    }

    public function checkout($id)
    {
        $event = EventPresale::with('event')->find($id);

        return view('form.checkout', compact('event'));
    }

    public function submitCheckout(CheckoutRequest $request, $id)
    {
        $validatedData = $request->validated();
        $presale = EventPresale::findOrFail($id);

        $randomNumber = mt_rand(100, 999);
        $status = ($validatedData['price'] == 0) ? 1 : 2;
        $newPrice = ($status == 1) ? 0 : floor($validatedData['price'] / 1000) * 1000 + $randomNumber;
        // Mendapatkan datetime saat ini
        $now = Carbon::now();

        // Menambahkan satu hari ke datetime saat ini
        $nextDay = $now->addDays(1);
        $validatedData['detail'] = [
            "quantity" => $validatedData['quantity'],
            "email" => $validatedData['email'],
            "phone" => $validatedData['phone'],
            "type" => $presale->event_price->variant,
            "end" => $nextDay,
        ];

        $invoice = Invoice::create([
            'event_id' => $presale->event->id,
            'last_three_value' => $randomNumber,
            'nama_pemilik' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'status' => $status,
            'price' => $newPrice,
            'detail' => $validatedData['detail'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($newPrice == 0) {
            $this->generateAndSendTicket($invoice->id);
        } else {
            Mail::to($validatedData['email'])->send(new InvoiceEmail($invoice));
        }
        return view('form.success', compact('newPrice', 'nextDay'));
    }
}
