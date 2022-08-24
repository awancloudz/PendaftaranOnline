@extends('layouts.main')

@section('container')
<h1 class="mb-3 text-center">Pendaftaran Peserta</h1>
<div class="row justify-content-center mb-3">
    <div class="col-lg-8 mb-3">
        <form method="post" action="/pendaftaran">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label"><b>Nama Lengkap</b></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" autofocus required value="{{  old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nohandphone" class="form-label"><b>No.Handphone</b></label>
                <input type="text" class="form-control @error('nohandphone') is-invalid @enderror" name="nohandphone" id="nohandphone"  required value="{{  old('nohandphone') }}">
                @error('nohandphone')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><b>Email</b></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{  old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nostr" class="form-label"><b>No.STR</b></label>
                <input type="text" class="form-control @error('nostr') is-invalid @enderror" name="nostr" id="nostr" required value="{{  old('nostr') }}">
                @error('nostr')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="asalpengcab" class="form-label"><b>Asal Pengcab</b></label>
                <input type="text" class="form-control @error('asalpengcab') is-invalid @enderror" name="asalpengcab" id="asalpengcab"  required value="{{  old('asalpengcab') }}">
                @error('asalpengcab')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="provinsi" class="form-label"><b>Provinsi</b></label>
                <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" required value="{{  old('provinsi') }}">
                @error('provinsi')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pilihan" class="form-label"><b>Kategori</b></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="offline" checked onclick="checkradio()">
                    <label class="form-check-label" for="status1">Offine / Datang Langsung</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status2" value="online" onclick="checkradio()">
                    <label class="form-check-label" for="status2">Online / Via Zoom</label>
                </div>
                <label for="pilihan" class="form-label"><b>Pilihan Jadwal & Harga</b></label>
                <div id="selectpilihan"></div>
            </div>
            <div class="mb-3">
                {!! htmlFormSnippet() !!}
            </div>
            <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran</button>
        </form>    
    </div>
</div>
<script>
checkradio();  
function checkradio(){
    const status1 = document.querySelector('#status1');
    const status2 = document.querySelector('#status2');
    
    if(status1.checked == true){
        var url = "/pendaftaran/cekpilihan/"+status1.value;
    }
    if(status2.checked == true){
        var url = "/pendaftaran/cekpilihan/"+status2.value;
    }
    fetch(url)
    .then(response => response.json())
    .then(function(data){
        var i=0;
        var arr = data.pilihans;
        var panjang = arr.length;
        
        var out = "<select class='form-select' name='pilihan_id' id='pilihan_id'>";
        for(i=0; i < panjang; i++){
            out+="<option value='"+ arr[i].id +"'>"+ rupiah(arr[i].harga) +" => "+ arr[i].deskripsi +"</option>";
        }
        out+="</select>";
        document.getElementById("selectpilihan").innerHTML = out;
    })
    .catch(err => console.log(err))
}

//FORMAT RUPIAH
function rupiah(nStr) {
   nStr += '';
   x = nStr.split('.');
   x1 = x[0];
   x2 = x.length > 1 ? '.' + x[1] : '';
   var rgx = /(\d+)(\d{3})/;
   while (rgx.test(x1))
   {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
   }
   return "Rp. " + x1 + x2;
}
</script>
@endsection