@csrf
@vite(['resources/js/komponenGaji.js'])
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Tambah Penggajian</h1>

    <form action="{{ route('admin.penggajian.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="id_anggota" class="block font-medium">Pilih Anggota</label>
            @if(isset($penggajian)) 
                <input type="text" 
                    class="border p-2 rounded w-full bg-gray-100" 
                    value="{{ $penggajian->anggota->nama_depan }} {{ $penggajian->anggota->nama_belakang }} ({{ $penggajian->anggota->jabatan }})" 
                    disabled>

                <input type="hidden" id="anggota-selected" 
                    name="id_anggota" 
                    value="{{ $penggajian->id_anggota }}" 
                    data-jabatan="{{ $penggajian->anggota->jabatan }}">
            @else
                <select name="id_anggota" id="anggota-select" class="border p-2 rounded w-full">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($anggota as $a)
                        <option value="{{ $a->id_anggota }}" 
                                data-jabatan="{{ $a->jabatan }}"
                                {{ old('id_anggota') == $a->id_anggota ? 'selected' : '' }}>
                            {{ $a->nama_depan }} {{ $a->nama_belakang }} ({{ $a->jabatan }})
                        </option>
                    @endforeach
                </select>
            @endif
            @error('id_anggota') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <div>
            <label for="id_komponen_gaji" class="block font-medium">Pilih Komponen Gaji</label>
            <select name="id_komponen_gaji" id="komponen-select" class="border p-2 rounded w-full mt-2">
                <option value="">-- Pilih Komponen --</option>
            </select>

            @error('id_komponen_gaji') 
                <p class="text-red-600 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Save
            </button>
            <a href="{{ route('admin.penggajian.index') }}" 
                class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Back
            </a>
        </div>
    </form>
</div>
