<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return barang::all();
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
        $this->validate($request,[
            'namabarang' =>'required|string|max:200',
            'lokasi' =>'required|string',
            'tersedia' =>'required|integer',
            'satuan' =>'required|string',
        ]);

        return barang::create([
            'namabarang' => $request->namabarang,
            'lokasi' => $request->lokasi,
            'tersedia' => $request->tersedia,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan,
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
        $this->validate($request,[
            'namabarang' =>'required|string|max:200',
            'lokasi' =>'required|string',
            'tersedia' =>'required|integer',
            'satuan' =>'required|string',
        ]);

        $dtBarang = [
            'namabarang' => $request->namabarang,
            'lokasi' => $request->lokasi,
            'tersedia' => $request->tersedia,
            'satuan' => $request->satuan,
            'keterangan' => $request->keterangan,
        ];

        $ubahData = barang::findOrFail($id);
        $ubahData->update($dtBarang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = barang::findOrFail($id);
        $hapus->delete();
    }
}
