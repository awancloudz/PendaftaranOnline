@extends('dashboard.layouts.main')

@section('container')
<div class="table-responsive">
            <h1 class="mb-3"></h1>
            <a href="/dashboard/peserta" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
        
            <table class="table table-striped table-md mt-3">
                <tr><td colspan="2" align="center"><h1 class="mb-3 mt-3">#{{ $invoices[0]->order_id }}<br><span class="badge bg-success">Lunas</span></h1></td></tr>
                <tr><td><h5>Total Bayar</h5></td><td><h5>: @currency($invoices[0]->gross_amount)</h5></td></tr>
                <tr><td><h5>Waktu Transaksi</h5></td><td><h5>: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $invoices[0]->transaction_time)->format('d-m-Y H:i:s') }}</h5></td></tr>
                <tr><td><h5>Status Transaksi</h5></td><td><h5>: {{ $invoices[0]->transaction_status }}</h5></td></tr>
                <tr><td><h5>Jenis Pembayaran</h5></td><td><h5>: {{ $invoices[0]->payment_type }}</h5></td></tr>
                @if($invoices[0]->bank != null)
                <tr><td><h5>Bank</h5></td><td><h5>: {{ $invoices[0]->bank }}</h5></td></tr>
                <tr><td><h5>Virtual Number</h5></td><td><h5>: {{ $invoices[0]->va_number }}</h5></td></tr>
                @endif
                @if($invoices[0]->store != null)
                <tr><td><h5>Store (Indomaret/Alfamart)</h5></td><td><h5>: {{ $invoices[0]->store }}</h5></td></tr>
                <tr><td><h5>Kode Pembayaran *jika bayar di store*</h5></td><td><h5>: {{ $invoices[0]->payment_code }}</h5></td></tr>
                <tr><td><h5>Kode Approval</h5></td><td><h5>: {{ $invoices[0]->approval_code }}</h5></td></tr>
                @endif
            </table>
</div>
@endsection