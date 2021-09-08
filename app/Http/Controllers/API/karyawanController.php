<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\karyawan;
use Illuminate\Http\Request;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return karyawan::all();
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
            'nama' =>'required|string|max:50',
            'departemen_id' =>'required|integer',
            'nik' =>'required|integer'
        ]);

        return karyawan::create([
            'nama' => $request->nama,
            'departemen_id' => $request->departemen_id,
            'nik' => $request->nik,
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
            'nama' =>'required|string|max:50',
            'departemen_id' =>'required|integer',
            'nik' =>'required|integer'
        ]);

        $dtKaryawan = [
            'nama' => $request->nama,
            'departemen_id' => $request->departemen_id,
            'nik' => $request->nik,

        ];

        $ubahData = karyawan::findOrFail($id);
        $ubahData->update($dtKaryawan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = karyawan::findOrFail($id);
        $hapus->delete();
    }
}
