<x-app-layout>
    <div class="container flex items-center justify-center h-screen">
        <div>
            <h1>Detail Anggota</h1>
            
            <div class="card p-4">
                <p><strong>Nama Depan</strong> {{ $anggota->nama_depan }}</p>
                <p><strong>Nama Belakang</strong> {{ $anggota->nama_belakang }}</p>
                <p><strong>Gelar Depan</strong> {{ $anggota->gelar_depan }}</p>
                <p><strong>Gelar Belakang</strong> {{ $anggota->gelar_belakang }}</p>
                <p><strong>Jabatan</strong> {{ $anggota->jabatan }}</p>
                <p><strong>Status Pernikahan</strong> {{ $anggota->status_pernikahan }}</p>
            </div>
            
            <div class="mt-4 flex space-x-3">
                <a href="{{ route('admin.anggota.index') }}" 
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Back
                </a>

                <a href="{{ route('admin.anggota.edit', $anggota) }}" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Edit
                </a>

                <form action="{{ route('admin.anggota.destroy', $anggota) }}" 
                    method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this anggota?')">
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