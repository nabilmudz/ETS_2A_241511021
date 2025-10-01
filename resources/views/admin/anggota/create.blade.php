<x-app-layout>
  <form action="{{ route('admin.anggota.store') }}" method="POST">
    @include('admin.anggota._form')
  </form>
</x-app-layout>
