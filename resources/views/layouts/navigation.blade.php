<nav x-data="{ open: false }" class="bg-dark-900 border-b border-neon/10 shadow-2xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded bg-neon flex items-center justify-center shadow-[0_0_10px_rgba(57,255,20,0.5)]">
                            <svg class="w-5 h-5 text-dark-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.57 14.86L22 13.43 20.57 12 17 15.57 8.43 7 12 3.43 10.57 2 9.14 3.43 7.71 2 5.57 4.14 4.14 2.71 2.71 4.14l1.43 1.43L2 7.71l1.43 1.43L2 10.57 3.43 12 7 8.43 15.57 17 12 20.57 13.43 22l1.43-1.43L16.29 22l2.14-2.14 1.43 1.43 1.43-1.43-1.43-1.43L22 16.29z" />
                            </svg>
                        </div>
                        <span class="font-display font-bold text-white tracking-tighter hidden md:block uppercase">LARAGYM<span class="text-neon">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-gray-400 hover:text-neon transition-colors duration-300 border-none">
                        {{ __('inicio') }}
                    </x-nav-link>x
                    <x-nav-link :href="route('dieta:active="request()->routeIs('dieta')" 
                        class="text-gray-400 hover:text-neon transition-colors duration-300 border-none">
                        {{ __('dieta') }}
                    </x-nav-link> 
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-neon/20 text-sm leading-4 font-medium rounded-xl text-neon bg-dark-800/50 hover:bg-neon/10 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-display uppercase tracking-widest">{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-dark-800 border border-neon/20 shadow-neon">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-neon/10 hover:text-neon">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="text-gray-300 hover:bg-red-500/10 hover:text-red-400"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>