@csrf
<div class="flex items-center justify-center h-screen px-4">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Anggota</h1>
            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Nama Depan</label>
                <input type="text" name="nama_depan" 
                       value="{{ old('nama_depan', $anggota->nama_depan ?? '') }}"
                       class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('nama_depan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Nama Belakang</label>
                <input type="text" name="nama_belakang" 
                       value="{{ old('nama_belakang', $anggota->nama_belakang ?? '') }}"
                       class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('nama_belakang') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Gelar Depan</label>
                <input type="text" name="gelar_depan" 
                       value="{{ old('gelar_depan', $anggota->gelar_depan ?? '') }}"
                       class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('gelar_depan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Gelar Belakang</label>
                <input type="text" name="gelar_belakang" 
                       value="{{ old('gelar_belakang', $anggota->gelar_belakang ?? '') }}"
                       class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('gelar_belakang') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Jabatan Dropdown --}}
            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Jabatan</label>
                <select name="jabatan" 
                        class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach(['Ketua','Wakil Ketua','Anggota'] as $jabatan)
                        <option value="{{ $jabatan }}" 
                            {{ old('jabatan', $anggota->jabatan ?? '') == $jabatan ? 'selected' : '' }}>
                            {{ $jabatan }}
                        </option>
                    @endforeach
                </select>
                @error('jabatan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex flex-col">
                <label class="mb-1 font-semibold">Status Pernikahan</label>
                <select name="status_pernikahan" 
                        class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Pilih Status --</option>
                    @foreach(['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                        <option value="{{ $status }}" 
                            {{ old('status_pernikahan', $anggota->status_pernikahan ?? '') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('status_pernikahan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-center mt-4 space-x-3">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save
                </button>

                <a href="{{ route('admin.anggota.index') }}" 
                   class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-center">
                   Back
                </a>
            </div>
        </form>
    </div>
</div>
