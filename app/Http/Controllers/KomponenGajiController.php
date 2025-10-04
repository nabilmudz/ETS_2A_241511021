<?php

namespace App\Http\Controllers;

use App\Models\KomponenGaji;
use App\Models\Anggota;
use Illuminate\Http\Request;

class KomponenGajiController extends Controller
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

    public function index(Request $request)
    {
        $query = KomponenGaji::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                    $q->orWhere('nama_depan', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%")
                        ->orWhere('jabatan', 'like', "%{$search}%")
                        ->orWhere('nominal', 'like', "%{$search}%")
                        ->orWhere('satuan', 'like', "%{$search}%")
                        ->orWhere('id_komponen_gaji', 'like', "%{$search}%");
                });
        }

        $gaji = $query->paginate(10)->withQueryString();
        return view('admin.komponen_gaji.index', compact('gaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.komponen_gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KomponenGaji::create($request->all());
        return redirect()->route('admin.komponen_gaji.index')->with('success', 'Komponen Gaji created.');
    }

    public function showByJabatan($jabatan){
        $komponen = KomponenGaji::where('jabatan',$jabatan)
            ->orWhere('jabatan', 'Semua')
            ->get();

        return response()->json($komponen);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KomponenGaji  $komponenGaji
     * @return \Illuminate\Http\Response
     */
    public function show(KomponenGaji $komponenGaji)
    {
        return view('admin.komponen_gaji.show', compact('komponenGaji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KomponenGaji  $komponenGaji
     * @return \Illuminate\Http\Response
     */
    public function edit(KomponenGaji $komponenGaji)
    {
        return view('admin.komponen_gaji.update', compact('komponenGaji'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KomponenGaji  $komponenGaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KomponenGaji $komponenGaji)
    {
        $komponenGaji->update($request->all());
        return redirect()->route('admin.komponen_gaji.index')->with('success', 'Komponen Gaji updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KomponenGaji  $komponenGaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomponenGaji $komponenGaji)
    {
        $komponenGaji->delete();
        return redirect()->route('admin.komponen_gaji.index')->with('success', 'Komponen Gaji deleted.');
    }
}
