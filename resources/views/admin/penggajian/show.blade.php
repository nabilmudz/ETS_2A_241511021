<x-app-layout>
    <div class="container flex items-center justify-center h-screen">
        <div>
            <h1>Detail Gaji</h1>
            
            <div class="card p-4">
                <p><strong>Nama Komponen</strong> {{ $komponenGaji->nama_depan }}</p>
                <p><strong>Kategori</strong> {{ $komponenGaji->kategori }}</p>
                <p><strong>Jabatan</strong> {{ $komponenGaji->jabatan }}</p>
                <p><strong>Nominal</strong> {{ $komponenGaji->nominal }}</p>
                <p><strong>Satuan</strong> {{ $komponenGaji->satuan }}</p>
            </div>
            
            <div class="mt-4 flex space-x-3">
                <a href="{{ route('admin.komponen_gaji.index') }}" 
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Back
                </a>

                <a href="{{ route('admin.komponen_gaji.edit', $komponenGaji) }}" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Edit
                </a>

                <form action="{{ route('admin.komponen_gaji.destroy', $komponenGaji) }}" 
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