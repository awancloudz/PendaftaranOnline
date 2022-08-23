@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-8 text-center">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('cancel'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('cancel') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <a href="/" class="btn btn-success">Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection