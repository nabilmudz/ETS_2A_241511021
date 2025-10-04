<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <p class="text-2xl font-bold text-black mr-10">ETS Proyek 3</p>
                </div>

                <div class="hidden sm:flex gap-8 mt-4">
                    @if(Auth::user()->role === 'Admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')">Anggota</x-nav-link>
                        <x-nav-link :href="route('admin.komponen_gaji.index')" :active="request()->routeIs('admin.komponen_gaji.*')">Komponen Gaji</x-nav-link>
                        <x-nav-link :href="route('admin.penggajian.index')" :active="request()->routeIs('admin.penggajian.*')">Penggajian</x-nav-link>
                    @elseif(Auth::user()->role === 'Public')
                        <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :href="route('user.anggota.index')" :active="request()->routeIs('user.anggota.*')">Anggota</x-nav-link>
                        <x-nav-link :href="route('user.penggajian.index')" :active="request()->routeIs('user.penggajian.*')">Penggajian</x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            <div>{{ Auth::user()->username }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role === 'Admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.anggota.index')" :active="request()->routeIs('admin.anggota.*')">Anggota</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.komponen_gaji.index')" :active="request()->routeIs('admin.komponen_gaji.*')">Komponen Gaji</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.penggajian.index')" :active="request()->routeIs('admin.penggajian.*')">Penggajian</x-responsive-nav-link>
            @elseif(Auth::user()->role === 'Public')
                <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.anggota.index')" :active="request()->routeIs('user.anggota.*')">Anggota</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('user.penggajian.index')" :active="request()->routeIs('user.penggajian.*')">Penggajian</x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
