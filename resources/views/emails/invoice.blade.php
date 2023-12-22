@component('mail::message')
# Invoice Pembelian

Berikut adalah detail pembelian Anda:

**Name**: {{ $invoice->nama_pemilik }}

**Event**: {{ $invoice->event->name }} ({{ $invoice->detail['type'] }})

**Quantity**: {{ $invoice->detail['quantity'] }}

**Tanggal Pembelian**: {{ $invoice->created_at->format('d/m/Y') }}

@component('mail::panel')
## Tutorial Pembayaran:

1. Transfer ke Rekening Bank Mandiri 1560021678836 A/N Gelorawan Susatyo.

2. Pastikan nominal pembayaran sesuai dengan yang diminta yaitu : **{{ 'Rp ' . number_format($invoice->price, 2, ',', '.') }}**

3. Mohon bayar sebelum **{{ \Carbon\Carbon::parse($invoice->detail['end'])->format('d/m/Y H:i:s') }}**

4. Jika sudah bayar, tunggu email e-ticket dari kami.

@endcomponent


Terima kasih telah melakukan pembelian.

Dari Tim Event UKM With Love
@endcomponent