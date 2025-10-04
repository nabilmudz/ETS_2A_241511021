<x-app-layout>
    <div class="container flex items-center justify-center h-screen">
        <div>
            <h1>Detail Penggajian</h1>
            
            <div class="card p-4">
                <p class="p-3"><strong>ID Komponen: </strong>{{ $penggajian->id_komponen_gaji }}</p>
                <p class="p-3"><strong>ID Anggota: </strong>{{ $penggajian->id_anggota }}</p>
                <p class="p-3"><strong>Nama Anggota: </strong>{{ $penggajian->anggota->nama_depan . ' ' . $penggajian->anggota->nama_belakang . ' ' . $penggajian->anggota->gelar_depan . ' ' . $penggajian->anggota->gelar_belakang}}</p>
                <p class="p-3"><strong>Jabatan: </strong>{{ $penggajian->anggota->jabatan }}</p>
                <p class="p-3"><strong>Nama Komponen: </strong>{{ $penggajian->komponen_gaji->nama_depan }}</p>
                <p class="p-3"><strong>Kategori: </strong>{{ $penggajian->komponen_gaji->kategori }}</p>
                <p class="p-3"><strong>Nominal: </strong>{{ $penggajian->komponen_gaji->nominal }}</p>
                <p class="p-3"><strong>Take Home Pay: </strong>{{ $penggajian->take_home_pay }}</p>
            </div>
            
            <div class="mt-4 flex space-x-3">
                <a href="{{ route('admin.penggajian.index') }}" 
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Back
                </a>

                <a href="{{ route('admin.penggajian.edit', [$penggajian->id_komponen_gaji, $penggajian->id_anggota]) }}" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Edit
                </a>

                <form action="{{ route('admin.penggajian.destroy', [$penggajian->id_komponen_gaji, $penggajian->id_anggota]) }}" 
                    method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this gaji?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>