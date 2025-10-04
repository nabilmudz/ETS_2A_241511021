<x-app-layout>
  <form action="{{ route('admin.komponen_gaji.store') }}" method="POST">
    @include('admin.komponen_gaji._form')
  </form>
</x-app-layout>
