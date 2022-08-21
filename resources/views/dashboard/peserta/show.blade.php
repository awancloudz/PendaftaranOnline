@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mb-3"></h1>
            <a href="/dashboard/peserta" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
            <form action="/dashboard/peserta/{{ $peserta->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger border-0" onclick="return confirm('Yakin menghapus data?')"><span data-feather="x-circle"></span> Delete</button>
            </form>
        
            <table class="table table-striped table-md">
                <tr><td colspan="2" align="center">
                    <?php
                    echo DNS2D::getBarcodeHTML($peserta->kodepeserta, 'QRCODE');
                    ?>
                    {{ $peserta->kodepeserta }}
                </td></tr>
                <tr><td colspan="2" align="center"><h1 class="mb-3 mt-3">{{ $peserta->nama }}</h1></td></tr>
                <tr><td><h5>Kode Peserta</h5></td><td><h5>: {{ $peserta->kodepeserta }}</h5></td></tr>
                <tr><td><h5>No.Handphone</h5></td><td><h5>: {{ $peserta->nohandphone }}</h5></td></tr>
                <tr><td><h5>Email</h5></td><td><h5>: {{ $peserta->email }}</h5></td></tr>
                <tr><td><h5>No.STR</h5></td><td><h5>: {{ $peserta->nostr }}</h5></td></tr>
                <tr><td><h5>Asal Pengcab</h5></td><td><h5>: {{ $peserta->asalpengcab }}</h5></td></tr>
                <tr><td><h5>Provinsi</h5></td><td><h5>: {{ $peserta->provinsi }}</h5></td></tr>
                <tr><td><h5>Pilihan Jadwal</h5></td><td><h5>: {{ $peserta->pilihan->deskripsi }}</h5></td></tr>
                <tr><td><h5>Status Bayar</h5></td>
                @if($peserta->statusbayar == 0)
                    <td><h5>: Belum</h5></td>
                @else
                    <td><h5>: Lunas</h5></td>
                @endif
                </tr>
                <tr><td><h5>Total Bayar</h5></td><td><h5>: @currency($peserta->totalbayar)</h5></td></tr>
            </table>
        </div>
    </div>
</div>
@endsection