<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
            'name' =>'required|string|max:50',
            'departemen_id' =>'required|integer',
            'email' =>'required|string|max:50',
            'password' =>'required',
        ]);

        return User::create([
            'name' => $request->name,
            'departemen_id' => $request->departemen_id,
            'email' => $request->email,
            'password' => bcrypt( $request->password ),

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
            'name' =>'required|string|max:50',
            'departemen_id' =>'required|integer',
            'email' =>'required|string|max:50',
            'password' =>'required',
        ]);

        $dtPengguna = [
            'name' => $request->name,
            'departemen_id' => $request->departemen_id,
            'email' => $request->email,
            'password' => bcrypt( $request->password ),

        ];

        $ubahData = User::findOrFail($id);
        $ubahData->update($dtPengguna);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = User::findOrFail($id);
        $hapus->delete();
    }
}
