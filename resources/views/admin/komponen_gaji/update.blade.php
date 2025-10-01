<x-app-layout>
    <form action="{{ route('admin.komponen_gaji.update', $komponenGaji) }}" method="post">
        @csrf
        @method('PUT')
        @include('admin.komponen_gaji._form')
    </form>
</x-app-layout>