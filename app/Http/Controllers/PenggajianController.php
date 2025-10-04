<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\KomponenGaji;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penggajian = Penggajian::all();
        return view('admin.penggajian.index', compact('penggajian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Anggota::all();
        $komponen = KomponenGaji::all();
        return view('admin.penggajian.create', compact('anggota', 'komponen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Penggajian::create($request->all());
        return redirect()->route('admin.penggajian.index')->with('success', 'Penggajian created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function show($id_komponen_gaji, $id_anggota)
    {
        $penggajian = Penggajian::where('id_komponen_gaji', $id_komponen_gaji)
                                ->where('id_anggota', $id_anggota)
                                ->firstOrFail();
        return view('admin.penggajian.show', compact('penggajian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function edit($id_komponen_gaji, $id_anggota)
    {
        $penggajian = Penggajian::where('id_komponen_gaji', $id_komponen_gaji)
                        ->where('id_anggota', $id_anggota)
                        ->firstOrFail();

        $komponen = KomponenGaji::all();
        return view('admin.penggajian.update', compact('penggajian', 'komponen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_komponen_gaji, $id_anggota)
    {
        Penggajian::where('id_komponen_gaji', $id_komponen_gaji)
            ->where('id_anggota', $id_anggota)
            ->update(['id_komponen_gaji' => $request->id_komponen_gaji]);

        return redirect()->route('admin.penggajian.index')->with('success', 'Penggajian Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_komponen_gaji, $id_anggota)
    {
        Penggajian::where('id_komponen_gaji', $id_komponen_gaji)
            ->where('id_anggota', $id_anggota)
            ->delete();
        return redirect()->route('admin.penggajian.index')->with('success','Penggajian Deleted');
    }
}
