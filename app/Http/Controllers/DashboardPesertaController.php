<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Notifikasi;

class DashboardPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.peserta.index', [
            'pesertas' => Peserta::latest()->paginate(15)
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('dashboard.peserta.show', [
            'peserta' => $peserta
        ]);
    }
    public function showinvoice($id)
    {
        $invoices = Notifikasi::where('order_id', $id)->where('transaction_status','settlement')->get();
        if($invoices->count() > 0){
            return view('dashboard.peserta.invoice', [
                'invoices' => $invoices
            ]);
        }
        else{
            return "<h1 align='center'>Data tidak ada!</h1>";
        }
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
    public function destroy($peserta)
    {
        Peserta::destroy($peserta);
        return redirect('/dashboard/peserta')->with('success', 'Peserta sukses dihapus!');
    }
}
