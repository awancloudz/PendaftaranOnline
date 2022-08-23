@extends('layouts.main')

@section('container')
<?php
header("Refresh: 60");
?>
<div class="row justify-content-center">
    <div class="col-lg-8 text-center">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Silahkan selesaikan pembayaran. Berikut adalah data pembayaran anda, harap bayar sesuai nominal dan pastikan rekening sudah benar.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="card text-center mb-3">
            <div class="card-header">
                <h5 class="card-title">Kode Pembayaran #{{ $peserta[0]->kodepeserta }}</h5>
                <h6>Nama Peserta : {{ $peserta[0]->nama }}</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title">Status Transaksi : {{ $notifikasi->transaction_status }}</h5>
                <h5 class="card-title">Jenis Pembayaran : {{ $notifikasi->payment_type }}</h5>
                @if($notifikasi->bank != null)
                <h5 class="card-title">Bank : {{ $notifikasi->bank }}</h5>
                <h5 class="card-title">Virtual Number : {{ $notifikasi->va_number }}</h5>
                @endif
                @if($notifikasi->permata_va_number != null)
                <h5 class="card-title">Permata Virtual Number : {{ $notifikasi->permata_va_number }}</h5>
                @endif
                @if($notifikasi->store != null)
                <h5 class="card-title">Store (Indomaret/Alfamart) : {{ $notifikasi->store }}</h5>
                <h5 class="card-title">Kode Pembayaran *jika bayar di store* : {{ $notifikasi->payment_code }}</h5>
                <h5 class="card-title">Kode Approval : {{ $notifikasi->approval_code }}</h5>
                @endif
                <h5 class="card-title">Total Bayar + 3 Digit Kode Unik</h5>
                <h3 class="card-title">@currency($peserta[0]->totalbayar)</h5>
            </div>
        </div>
        <a href="/" class="btn btn-success">Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection