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

    public function index(Request $request)
    {
        $query = Penggajian::with(['anggota', 'komponen_gaji']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('anggota', function ($q) use ($search) {
                $q->where('nama_depan', 'like', "%{$search}%")
                ->orWhere('nama_belakang', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%")
                ->orWhere('id_anggota', 'like', "%{$search}%");
            });
        }

        $penggajian = $query->paginate(10);

        
        $penggajian->getCollection()->transform(function ($p) {
            $nominalPasangan = KomponenGaji::where('nama_depan', 'Tunjangan Istri/Suami')->value('nominal');
            $nominalAnak = KomponenGaji::where('nama_depan', 'Tunjangan Anak')->value('nominal');
            $base = $p->komponen_gaji ? $p->komponen_gaji->nominal : 0;

            $tunjanganPasangan = $p->anggota->status_pernikahan === 'Kawin' ? $nominalPasangan : 0;

            $anakDihitung = min($p->anggota->jumlah_anak, 2);
            $tunjanganAnak = $anakDihitung * $nominalAnak;

            $p->take_home_pay = $base + $tunjanganPasangan + $tunjanganAnak;

            return $p;
        });

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
                                
        $nominalPasangan = KomponenGaji::where('nama_depan', 'Tunjangan Istri/Suami')->value('nominal') ?? 0;
        $nominalAnak = KomponenGaji::where('nama_depan', 'Tunjangan Anak')->value('nominal') ?? 0;

        $base = $penggajian->komponen_gaji ? $penggajian->komponen_gaji->nominal : 0;

        $tunjanganPasangan = $penggajian->anggota->status_pernikahan === 'Kawin' 
            ? $nominalPasangan 
            : 0;

        $anakDihitung = min($penggajian->anggota->jumlah_anak, 2);
        $tunjanganAnak = $anakDihitung * $nominalAnak;

        $penggajian->take_home_pay = $base + $tunjanganPasangan + $tunjanganAnak;
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
