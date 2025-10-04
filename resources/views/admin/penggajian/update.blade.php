<x-app-layout>
    <form action="{{ route('admin.penggajian.update', [$penggajian->id_komponen_gaji, $penggajian->id_anggota]) }}" method="post">
        @csrf
        @method('PUT')
        @include('admin.penggajian._form')
    </form>
</x-app-layout>