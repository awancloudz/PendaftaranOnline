@extends('dashboard.layouts.main')

@section('container')
<h5 class="mt-5 mb-5" align="center">Selamat Datang, {{ auth()->user()->name }}</h5>
<div align="center">
  <img src="/img/iropin50th.png" alt="" width="500"><img src="/img/iropin.png" alt="" width="400">
</div>
@endsection