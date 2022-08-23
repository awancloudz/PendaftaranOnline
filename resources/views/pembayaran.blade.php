@extends('layouts.main')

@section('container')
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.midtrans.com/snap/snap.js"
      data-client-key="Mid-client-MePyTzVX9H4Pjg16"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
  </head>
 
  <body>
    @if($peserta ?? '')
    <div class="row justify-content-center mb-3">
      <div class="col-lg-8 mb-3">
        <div class="card text-center">
          <div class="card-header">
            <h5 class="card-title">Kode Pembayaran #{{ $peserta['kodepeserta'] }}</h5>
            <h6>{{ $peserta['nama'] }}</h6>
          </div>
          <div class="card-body">
            <h5 class="card-title">Total Bayar + 3 Digit Kode Unik</h5>
            <h3 class="card-title">@currency($peserta['totalbayar'])</h5>
            <p class="card-text">Silahkan klik tombol dibawah untuk memilih metode pembayaran. Anda akan menerima pemberitahuan via email yang anda daftarkan.</p>
            <button id="pay-button" class="btn btn-primary">Pilih Metode Pembayaran</button>
          </div>
        </div>
      </div>
    </div>

      <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{ $peserta['snapToken'] }}');
          // customer will be redirected after completing payment pop-up
        });
      </script>
    @else
    <h1 class="mt-3" align="center">Maaf, Belum ada data!</h1>
    @endif
  </body>
</html>
@endsection