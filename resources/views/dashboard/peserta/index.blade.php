@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Peserta
        @if(request('statusbayar') == "lunas")
        - Lunas
        @elseif(request('statusbayar') == "belum")
        - Belum Lunas
        @else
        - Semua
        @endif
      </h1>
    </div>
    <div class="row mb-3">
      <div class="col-md-2">
        <a class="btn btn-outline-success mt-3" href="/dashboard/peserta?statusbayar=lunas">Lunas</a>
        <a class="btn btn-outline-danger mt-3" href="/dashboard/peserta?statusbayar=belum">Belum</a>
      </div>
      <div class="col-md-6">
          <form action="/dashboard/peserta">
              @if(request('statusbayar'))
                  <input type="hidden" name="statusbayar" value="{{ request('statusbayar') }}">
              @endif
              <div class="input-group mb-3 mt-3">
                  <input type="text" class="form-control" placeholder="Cari kode peserta" name="kodepeserta" value="{{ request('kodepeserta') }}">
                  <button class="btn btn-outline-primary" type="submit">Cari</button>
              </div>
          </form>
      </div>
    </div>
    <div class="table-responsive">
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        {{-- <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a> --}}
        @if($pesertas->count())
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Kode Peserta</th>
              <th scope="col">Nama</th>
              <th scope="col">No.Handphone</th>
              <th scope="col">Email</th>
              <th scope="col">Status Bayar</th>
              <th scope="col">Total Bayar</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pesertas as $peserta)
            <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $peserta->id }}</td>
                <td>{{ $peserta->kodepeserta }}</td>
                <td>{{ $peserta->nama }}</td>
                <td>{{ $peserta->nohandphone }}</td>
                <td>{{ $peserta->email }}</td>
                @if($peserta->statusbayar == 0)
                <td class="text-danger">Belum</td>
                @else
                <td class="text-success">Lunas <a href="/dashboard/peserta/invoice/{{ $peserta->kodepeserta }}" class="badge bg-success"><span data-feather="file-text"></span></a></td>
                @endif
                <td>@currency($peserta->totalbayar)</td>
                <td>
                    <a href="/dashboard/peserta/{{ $peserta->id }}" class="badge bg-warning"><span data-feather="eye"></span></a>
                    {{-- <a href="/dashboard/peserta/{{ $peserta->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a> --}}
                    <form action="/dashboard/peserta/{{ $peserta->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Yakin menghapus data?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <p class="text-center fs-4">Tidak ada data peserta!</p>
        @endif
    </div>
    <div class="d-flex justify-content-end">
      {{  $pesertas->links() }}
    </div>
@endsection