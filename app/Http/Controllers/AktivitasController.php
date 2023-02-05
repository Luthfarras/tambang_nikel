<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Aktivitas::all();
        return view('aktivitas', compact('data'));
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
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function show(Aktivitas $aktivitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Aktivitas $aktivitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aktivitas $aktivitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aktivitas $aktivitas)
    {
        $aktivitas->delete();
        return redirect('aktivitas');
    }
}
