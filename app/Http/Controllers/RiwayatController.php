<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Aktivitas;
use App\Models\Kendaraan;
use App\Charts\RiwayatChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Riwayat::all();
        return view('riwayat', compact('data'));
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
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show(Riwayat $riwayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {
        $kendaraan = Kendaraan::find($riwayat->kendaraan_id);
        if ($kendaraan->status == 1) {
            $kendaraan->update([
                'status' => 0,
            ]);
        }
        Aktivitas::create([
            'deskripsi' => 'Menghapus data riwayat' .$riwayat->tanggal_pakai,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);

        $riwayat->delete();
        return redirect('riwayat')->with('success', 'Berhasil Hapus Data');
    }

    public function status(Riwayat $riwayat)
    {
        $kendaraan = Kendaraan::find($riwayat->kendaraan_id);
        if (Auth::user()->role == 'Admin') {
            $riwayat->update([
                'status' => 1,
            ]);
            $kendaraan->update([
                'status' => 0,
            ]);
            Aktivitas::create([
                'deskripsi' => 'Mengganti status riwayat',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
    
            return redirect('riwayat')->with('success', 'Berhasil Mengembalikan');
        } else {
            return redirect('riwayat')->with('warning', 'Anda tidak memiliki akses');
        }
    }

    public function chart()
    {
        $riwayat = Riwayat::all();
        return response()->json($riwayat);    
    }
}
