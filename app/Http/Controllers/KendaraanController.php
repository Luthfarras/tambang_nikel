<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kendaraan::all();
        return view('kendaraan', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'nama_kendaraan' => 'required',
            'jenis' => 'required',
            'konsumsi_bbm' => 'required',
            'jadwal' => 'required',
            'asal' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('kendaraan')->with('error', 'Gagal Tambah Kendaraan');
        } else {
            Kendaraan::create($request->all());
            Aktivitas::create([
                'deskripsi' => 'Menambah data kendaraan',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('kendaraan')->with('success', 'Berhasil Tambah Kendaraan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $kendaraan->update($request->all());
        Aktivitas::create([
            'deskripsi' => 'Mengubah data kendaraan',
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('kendaraan')->with('success', 'Berhasil Ubah Kendaraan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        Aktivitas::create([
            'deskripsi' => 'Menghapus data kendaraan' .$kendaraan->nama_kendaraan,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        $kendaraan->delete();
        return redirect('kendaraan')->with('success', 'Berhasil Hapus Data Kendaraan');
    }
}
