<?php

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use App\Mail\TicketEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $post = Invoice::find($postId);
        $post->update([
            'status' => 1
        ]);

        // $this->generateAndSendTicket();
    }
    public function changeTab($status)
    {
        $this->statusCode = $status;
    }
    private function generateAndSendTicket()
    {
        set_time_limit(300);


        // Generate QR code
        $filePath = 'public/tickets/qrcode_' . $this->postId . '.png';

        // Ensure the directory exists, create it if necessary
        if (!Storage::exists(dirname($filePath))) {
            Storage::makeDirectory(dirname($filePath));
        }
        $qrCodePath = storage_path('app/public/tickets/qrcode_' . $this->postId . '.png');
        QrCode::size(300)->generate($this->postId, $qrCodePath);

        // Download image using Guzzle
        $imagePath = $this->invoice->event->post->cover_image;

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', compact('invoice', 'qrCodePath', 'imagePath'));

        // Save PDF to storage (optional)
        $pdfPath = storage_path('app/public/tickets/ticket_' . $this->postId . '.pdf');
        $pdf->save($pdfPath);

        // Send email with PDF attachment
        Mail::to($this->invoice->detail['email'])->send(new TicketEmail($this->invoice, $pdfPath));
    }
}
