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
        Peserta::create($validatedData);
        return redirect('/pembayaran');
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
