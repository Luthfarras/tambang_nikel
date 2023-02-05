<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use App\Models\User;
use App\Models\Driver;
use App\Models\Riwayat;
use App\Models\Aktivitas;
use App\Models\Kendaraan;
use App\Exports\SewaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sewa::all();
        $user = User::where('role', 'Penyetuju')->get();
        $kendaraan = Kendaraan::all();
        $driver = Driver::all();
        return view('sewa', compact('data', 'user', 'kendaraan', 'driver'));
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
            'tanggal_sewa' => 'required',
            'kendaraan_id' => 'required',
            'driver_id' => 'required',
            'pihak_1' => 'required',
            'pihak_2' => 'required',
        ]);

        $kendaraan = Kendaraan::find($request->kendaraan_id);

        if ($validator->fails()) {
            return redirect('sewa')->with('error', 'Gagal Menyewa');
        } elseif ($request->pihak_1 == $request->pihak_2) {
            return redirect('sewa')->with('error', 'Pihak tidak boleh sama');
        } elseif ($kendaraan->status == 1) {
            return redirect('sewa')->with('error', 'Kendaraan tidak tersedia');
        } else {
            Sewa::create($request->all());
            Aktivitas::create([
                'deskripsi' => 'Menambah data penyewaan',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('sewa')->with('success', 'Berhasil Menyewa');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function show(Sewa $sewa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sewa $sewa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sewa $sewa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sewa  $sewa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sewa $sewa)
    {
        Aktivitas::create([
            'deskripsi' => 'Menghapus data sewa' .$sewa->tanggal_sewa,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        $sewa->delete();
        return redirect('sewa')->with('success', 'Berhasil Hapus Data');
    }
    
    public function acc1(Sewa $sewa)
    {
        if ($sewa->pihak_1 == Auth::user()->id) {
            $sewa->update([
                'acc_1' => 1,
            ]);
            Aktivitas::create([
                'deskripsi' => 'Menyetujui penyewaan',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('sewa')->with('success', 'Berhasil Menyetujui');
        }else {
            return redirect('sewa')->with('error', 'Anda bukan pihak yang bersangkutan!');
        }
    }
    public function acc2(Sewa $sewa)
    {
        if ($sewa->acc_1 == 0) {
            return redirect('sewa')->with('error', 'Tunggu persetujuan Pihak 1');
        }elseif ($sewa->pihak_2 == Auth::user()->id) {
            $sewa->update([
                'acc_2' => 1,
            ]);
            Aktivitas::create([
                'deskripsi' => 'Menyetujui penyewaan',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);

            Riwayat::create([
                'tanggal_pakai' => $sewa->tanggal_sewa,
                'kendaraan_id' => $sewa->kendaraan_id,
                'sewa_id' => $sewa->id,
            ]);

            $kendaraan = Kendaraan::find($sewa->kendaraan_id);
            $kendaraan->update([
                'status' => 1,
            ]);

            return redirect('sewa')->with('success', 'Berhasil Menyetujui');
        }else {
            return redirect('sewa')->with('error', 'Anda bukan pihak yang bersangkutan!');
        }
    }

    public function export()
    {
        return Excel::download(new SewaExport, 'list-penyewaan.xlsx');
    }
}
