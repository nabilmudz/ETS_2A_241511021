@csrf
<div class="flex items-center justify-center h-screen px-4">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Komponen Gaji</h1>
            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Nama Komponen</label>
                <input type="text" name="nama_depan" 
                       value="{{ old('nama_depan', $komponenGaji->nama_depan ?? '') }}"
                       class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('nama_depan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Kategori</label>
                <select name="kategori" 
                        class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(['Gaji Pokok','Tunjangan Melekat','Tunjangan Lain'] as $kategori)
                        <option value="{{ $kategori }}" 
                            {{ old('kategori', $komponenGaji->kategori ?? '') == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
                @error('nama_belakang') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Jabatan</label>
                <select name="jabatan" 
                        class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach(['Ketua','Wakil Ketua','komponenGaji', 'Semua'] as $jabatan)
                        <option value="{{ $jabatan }}" 
                            {{ old('jabatan', $komponenGaji->jabatan ?? '') == $jabatan ? 'selected' : '' }}>
                            {{ $jabatan }}
                        </option>
                    @endforeach
                </select>
                @error('nama_belakang') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Nominal</label>
                <input type="number" name="nominal" 
                       value="{{ old('nominal', $komponenGaji->nominal ?? '') }}"
                       class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('nominal') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Satuan</label>
                <select name="satuan" 
                        class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Pilih satuan --</option>
                    @foreach(['Bulan','Hari','Periode'] as $satuan)
                        <option value="{{ $satuan }}"   
                            {{ old('satuan', $komponenGaji->satuan ?? '') == $satuan ? 'selected' : '' }}>
                            {{ $satuan }}
                        </option>
                    @endforeach
                </select>
                @error('satuan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-center mt-4 space-x-3">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save
                </button>

                <a href="{{ route('admin.komponen_gaji.index') }}" 
                   class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-center">
                   Back
                </a>
            </div>
        </form>
    </div>
</div>
