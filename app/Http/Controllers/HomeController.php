<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilihan;
use App\Models\Peserta;
use App\Models\Notifikasi;
use DateTime;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //1.VALIDASI DATA PESERTA
        $date   = new DateTime(); //this returns the current date time
        $result = $date->format('Y-m-d-H-i-s');
        $krr    = explode('-', $result);
        $result = implode("", $krr);

        $kodeakhir = Peserta::orderBy('id', 'desc')->first();
        if($kodeakhir != null){
            $kodepeserta = $kodeakhir->id + 1 . $result;
        }
        else{
            $kodepeserta = "1". $result;
        }

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'pilihan_id' => 'required',
            'nohandphone' => 'required|unique:pesertas',
            'email' => 'required|email|unique:pesertas',
            'nostr' => 'required',
            'asalpengcab' => 'required',
            'provinsi' => 'required',
        ]);

        $validatedData['kodepeserta'] = $kodepeserta;

        $pilihans = Pilihan::where('id', $validatedData['pilihan_id'])->get();
        $harga = $pilihans[0]->harga;
        $deskripsi = "[ " . $pilihans[0]->jenis . " ] " . $pilihans[0]->deskripsi;
        $randomnumber = mt_rand(100,999);
        $validatedData['totalbayar'] = $harga + $randomnumber;
        Peserta::create($validatedData);
        
        //2. VALIDASI PEMBAYARAN
        \Midtrans\Config::$serverKey = 'Mid-server-HHv1WljQylXqs21Z-aJ55ADh';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => $kodepeserta,
                'gross_amount' => $validatedData['totalbayar'],
            ),
            'customer_details' => array(
                'first_name' => $validatedData['nama'],
                'last_name' => '',
                'email' => $validatedData['email'],
                'phone' => $validatedData['nohandphone'],
            ),
            'item_details' => array(
                ['id' => 1,
                'price' => $validatedData['totalbayar'],
                'quantity' => 1,
                'name' => $deskripsi],
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $validatedData['snapToken'] = $snapToken;
        
        return view('pembayaran', [
            'peserta' => $validatedData
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
    }

    public function checkPilihan($pilihan){
        $pilihans = Pilihan::where('jenis', $pilihan)->get();
        return response()->json(['pilihans' => $pilihans]);
    }

    public function verified(){
        $order_id = request('order_id');
        if($order_id != ''){
            $notifikasi = Notifikasi::where('order_id', $order_id)->latest()->first();
            $peserta = Peserta::where('kodepeserta', $order_id)->get();
            $seleksi = json_decode($notifikasi);
            if($seleksi->transaction_status == "settlement"){
                return redirect('/pendaftaran/finish')->with('success','Pendaftaran & Pembayaran Sukses, Bukti Pembayaran akan dikirim via Email. Terima Kasih.');
            }
            else if($seleksi->transaction_status == "cancel"){
                return redirect('/pendaftaran/finish')->with('cancel','Maaf, Pendaftaran & Pembayaran sudah dibatalkan.');
            }
            else if($seleksi->transaction_status == "pending"){
                return view('pending', [
                    'peserta' => $peserta,
                    'notifikasi' => $notifikasi
                ]);
            }
        }
        else{
            return redirect('/');
        }
    }

    public function notifikasi(Request $request){
        //1. Simpan notifikasi pembayaran | buat database notapembayaran
        $vanumber = $request->input('va_numbers');
        $order_id = $request->input('order_id');
        $status = $request->input('transaction_status');
        if($vanumber != ''){
            $request['va_number'] = $request->input('va_numbers.0.va_number');
            $request['bank'] = $request->input('va_numbers.0.bank');
        }
        $notifikasi = $request->all();
        Notifikasi::create($notifikasi);

        //2. update data peserta | set status sudah bayar
        if($status == "settlement"){
            $datapeserta = Peserta::where('kodepeserta', $order_id)->get();
            foreach($datapeserta as $peserta){
                $peserta->statusbayar = 1;
                $peserta->update();
            }
        }
        return "Notifikasi Sukses!";
    }
}
