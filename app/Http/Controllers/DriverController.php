<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Driver::all();
        return view('driver', compact('data'));
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
            'nama_driver' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('driver')->with('error', 'Gagal Tambah Driver');
        } else {
            Driver::create($request->all());
            Aktivitas::create([
                'deskripsi' => 'Menambah data driver',
                'user_id' => Auth::user()->id,
                'waktu' => Carbon::now(),
            ]);
            return redirect('driver')->with('success', 'Berhasil Tambah Driver');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());
        Aktivitas::create([
            'deskripsi' => 'Mengubah data driver' .$driver->nama_driver,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        return redirect('driver')->with('success', 'Berhasil Ubah Data Driver');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        Aktivitas::create([
            'deskripsi' => 'Menghapus data driver' .$driver->nama_driver,
            'user_id' => Auth::user()->id,
            'waktu' => Carbon::now(),
        ]);
        $driver->delete();
        return redirect('driver')->with('success', 'Berhasil Hapus Data Driver');
    }
}
