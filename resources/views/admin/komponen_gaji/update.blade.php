<x-app-layout>
    <form action="{{ route('admin.anggota.update', $anggota) }}" method="post">
        @csrf
        @method('PUT')
        @include('admin.anggota._form')
    </form>
</x-app-layout>