<?php

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Component;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\TicketEmail;


class TransaksiAdmin extends Component
{
    public $invoice, $postId;
    public $statusCode = 2;

    public function render()
    {
        $this->invoice = Invoice::where('status', $this->statusCode)->latest()->get();
        return view('livewire.transaksi-admin');
    }

    public function approve($postId)
    {
        // dd("kontol");
        $post = Invoice::find($postId);
        $post->update([
            'status' => 1

        ]);
        $this->generateAndSendTicket($postId);
    }

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

        // Save PDF to storage (optional)
        $pdfPath = storage_path('app/public/tickets/ticket_' . $invoiceId . '.pdf');
        $pdf->save($pdfPath);

        // Send email with PDF attachment
        Mail::to($invoice->detail['email'])->send(new TicketEmail($invoice, $pdfPath));
        $ukm = $invoice->event->post->ukm;
        $ukm->saldo += $invoice->price - 5000 - $invoice->last_three_value;
        $ukm->update();
        session()->flash('message', 'Berhasil Approve');
        return response()->json(['message' => 'Ticket sent successfully']);
    }

    public function changeTab($status)
    {
        $this->statusCode = $status;
    }
}
