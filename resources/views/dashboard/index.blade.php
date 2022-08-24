@extends('dashboard.layouts.main')

@section('container')
<h5 class="mt-5 mb-5" align="center">Selamat Datang, {{ auth()->user()->name }}</h5>
<div align="center" style="overflow:hidden;">
  <img class="img-fluid" src="/img/iropin50th.png" alt="" width="300">
  <img class="img-fluid" src="/img/iropin.png" alt="" width="200">
</div>
@endsection