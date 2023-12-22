@component('mail::message')
# Tiket Pembelian

Berikut adalah tiket Anda:

**ID Invoice**: {{ $invoice->id }}
**Nama Pemilik**: {{ $invoice->nama_pemilik }}
<!-- Tambahkan informasi tiket lainnya -->

Terima kasih telah melakukan pembelian.

Terima kasih,
Dari Tim Event UKM With Love
@endcomponent