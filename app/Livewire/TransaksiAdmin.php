<?php

namespace App\Livewire;

use App\Models\Invoice;
use Livewire\Component;


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
    }
    public function changeTab($status)
    {
        $this->statusCode = $status;
    }
}
