@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Peserta</h1>
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
              <th scope="col">Nama</th>
              <th scope="col">No.Handphone</th>
              <th scope="col">Email</th>
              <th scope="col">Status Bayar</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pesertas as $peserta)
            <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $peserta->id }}</td>
                <td>{{ $peserta->nama }}</td>
                <td>{{ $peserta->nohandphone }}</td>
                <td>{{ $peserta->email }}</td>
                @if($peserta->statusbayar == 0)
                <td>Belum</td>
                @else
                <td>Lunas</td>
                @endif
                <td>
                    <a href="/dashboard/peserta/{{ $peserta->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
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
          <p class="text-center fs-4">Belum ada data peserta!</p>
        @endif
    </div>
    <div class="d-flex justify-content-end">
      {{  $pesertas->links() }}
    </div>
@endsection