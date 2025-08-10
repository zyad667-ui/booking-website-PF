<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span class="ml-2 text-xl font-bold text-gray-800">PlaceZo</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Bouton Accueil -->
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        {{ __('Accueil') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Liens spécifiques aux rôles -->
                    @role('admin')
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                            {{ __('Utilisateurs') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.listings.index') }}" :active="request()->routeIs('admin.listings.*')">
                            {{ __('Annonces') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.bookings.index') }}" :active="request()->routeIs('admin.bookings.*')">
                            {{ __('Réservations') }}
                        </x-nav-link>
                    @endrole

                    @role('host')
                        <x-nav-link href="{{ route('listings.index') }}" :active="request()->routeIs('listings.*')">
                            {{ __('Mes Annonces') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('bookings.index') }}" :active="request()->routeIs('bookings.*')">
                            {{ __('Réservations') }}
                        </x-nav-link>
                    @endrole

                    @role('client')
                        <x-nav-link href="{{ route('listings.index') }}" :active="request()->routeIs('listings.*')">
                            {{ __('Logements') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('bookings.index') }}" :active="request()->routeIs('bookings.*')">
                            {{ __('Mes Réservations') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('client.favorites') }}" :active="request()->routeIs('client.favorites')">
                            {{ __('Favoris') }}
                        </x-nav-link>
                    @endrole

                    <x-nav-link href="{{ route('messages.index') }}" :active="request()->routeIs('messages.*')">
                        {{ __('Messages') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mr-2">
                                        <span class="text-white text-sm font-medium">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Bouton Accueil Mobile -->
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ __('Accueil') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Liens spécifiques aux rôles Mobile -->
            @role('admin')
                <x-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                    {{ __('Utilisateurs') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.listings.index') }}" :active="request()->routeIs('admin.listings.*')">
                    {{ __('Annonces') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.bookings.index') }}" :active="request()->routeIs('admin.bookings.*')">
                    {{ __('Réservations') }}
                </x-responsive-nav-link>
            @endrole

            @role('host')
                <x-responsive-nav-link href="{{ route('listings.index') }}" :active="request()->routeIs('listings.*')">
                    {{ __('Mes Annonces') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('bookings.index') }}" :active="request()->routeIs('bookings.*')">
                    {{ __('Réservations') }}
                </x-responsive-nav-link>
            @endrole

            @role('client')
                <x-responsive-nav-link href="{{ route('listings.index') }}" :active="request()->routeIs('listings.*')">
                    {{ __('Logements') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('bookings.index') }}" :active="request()->routeIs('bookings.*')">
                    {{ __('Mes Réservations') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('client.favorites') }}" :active="request()->routeIs('client.favorites')">
                    {{ __('Favoris') }}
                </x-responsive-nav-link>
            @endrole

            <x-responsive-nav-link href="{{ route('messages.index') }}" :active="request()->routeIs('messages.*')">
                {{ __('Messages') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.edit') }}">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
