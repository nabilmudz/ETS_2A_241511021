<x-app-layout>
  <div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6 px-4">
      <h1 class="text-2xl font-bold text-gray-800">Daftar Penggajian</h1>
      <a href="{{ route('admin.penggajian.create') }}" 
         class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
         Create
      </a>
    </div>

    @if(session('success')) 
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
      </div> 
    @endif
    
    <div class="overflow-x-auto px-4">    
      <form method="GET" action="{{ route('admin.penggajian.index') }}" class="mb-4">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari..." 
            class="border rounded px-3 py-2 w-1/3"
        >
        <button 
            type="submit" 
            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Search
        </button>
      </form>
      <table class="w-full border-2 border-black rounded-lg shadow">
        <thead>
          <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm">
            <th class="p-3">No</th>
            <th class="p-3">ID Anggota</th>
            <th class="p-3">Gelar Depan</th>
            <th class="p-3">Nama Depan</th>
            <th class="p-3">Nama Belakang</th>
            <th class="p-3">Gelar Belakang</th>
            <th class="p-3 text-center">Jabatan</th>
            <th class="p-3 text-center">Take Home Pay</th>
            @if(Auth::user()->role !== 'Public')
            <th class="p-3 text-center">Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($penggajian as $p)
          <tr class="hover:bg-gray-50">
            <td class="p-3">{{ $p->id_anggota }}</td>
            <td class="p-3">{{ $p->anggota->id_anggota }}</td>
            <td class="p-3">{{ $p->anggota->gelar_depan }}</td>
            <td class="p-3">{{ $p->anggota->nama_depan }}</td>
            <td class="p-3">{{ $p->anggota->nama_belakang }}</td>
            <td class="p-3">{{ $p->anggota->gelar_belakang }}</td>
            <td class="p-3">{{ $p->anggota->jabatan }}</td>
            <td class="p-3">{{ $p->take_home_pay }}</td>
            
            @if(Auth::user()->role !== 'Public')
              <td class="p-3 flex items-center justify-center space-x-2">
                <a href="{{ route('admin.penggajian.show', [$p->id_komponen_gaji, $p->id_anggota]) }}" 
                  class="text-blue-600 hover:underline">View</a>
                <a href="{{ route('admin.penggajian.edit', [$p->id_komponen_gaji, $p->id_anggota]) }}" 
                  class="text-yellow-600 hover:underline">Edit</a>

                <form action="{{ route('admin.penggajian.destroy', [$p->id_komponen_gaji, $p->id_anggota]) }}" method="POST" 
                      onsubmit="return confirm('Delete?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" 
                          class="text-red-600 hover:underline">Delete</button>
                </form>
              </td>
            @endif
          </tr>
          @empty
          <tr>
            <td colspan="4" class="p-3 text-center text-gray-500">No penggajian yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="mt-4">
        {{ $penggajian->appends(['search' => request('search')])->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
