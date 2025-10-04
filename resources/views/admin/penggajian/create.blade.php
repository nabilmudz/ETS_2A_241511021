<x-app-layout>
  <form action="{{ route('admin.penggajian.store') }}" method="POST">
    @include('admin.penggajian._form')
  </form>
</x-app-layout>
