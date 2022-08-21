<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilihan;
use App\Models\Peserta;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.VALIDASI DATA PESERTA
        $kodeakhir = Peserta::orderBy('id', 'desc')->first();
        if($kodeakhir->count() > 0){
            $kodepeserta = "SMG-". sprintf("%010s", $kodeakhir->id + 1);
        }
        else{
            $kodepeserta = "SMG-0000000001";
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
        $randomnumber = mt_rand(100,999);
        $validatedData['totalbayar'] = $harga + $randomnumber;
        Peserta::create($validatedData);
        //return redirect('/pendaftaran/finish')->with('success','Pendaftaran Sukses! Terima Kasih.');
        
        //2. VALIDASI PEMBAYARAN
        \Midtrans\Config::$serverKey = 'SB-Mid-server-MYkfBbwTKoYZOVi2ys6Rdck9';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkPilihan($pilihan){
        $pilihans = Pilihan::where('jenis', $pilihan)->get();
        return response()->json(['pilihans' => $pilihans]);
    }
}
