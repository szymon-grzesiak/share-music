<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        <!-- Styles -->
        @livewireStyles
        @laravelViewsStyles('laravel-views')
        <!-- Scripts -->
        @wireUiScripts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <x-wireui-notifications />
        <x-wireui-dialog />
        <div class="">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header id="headerId" class="shadow" style="background-color: rgb(30,30,65)">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <div class="flex">
                <aside class="bg-[rgb(30,30,65)] sticky left-0 top-0 h-screen overflow-y-auto p-6 pt-12 w-full max-w-[300px]">
                    <h2 class="text-white text-2xl mb-10">Biblioteka</h2>
                    <div>
                        <ul class="flex flex-col gap-4">
                            @foreach ($playlists as $playlist)
                                <li>
                                    <a class="hover:bg-white/10 text-white flex justify-start items-center gap-x-4" href="{{ route('playlists.songs', ['playlist' => $playlist->id]) }}" >
                                        <img class="w-[60px] h-[60px]" src="{{$playlist->image}}" alt="{{$playlist->name}}"/>
                                        <span>{{ strlen($playlist->name) > 15 ? substr($playlist->name, 0, 15) . '...' : $playlist->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
                <main class="w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
        @laravelViewsScripts('laravel-views')


        <script>
            function toggleTheme() {
                let moonIcon = document.getElementById('moon-icon');
                let sunIcon = document.getElementById('sun-icon');


                moonIcon.classList.toggle('hidden');
                sunIcon.classList.toggle('hidden');

                let htmlElement = document.documentElement;
                htmlElement.classList.toggle('dark');

                // Save the current theme state to local storage
                if (htmlElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            }

            function applySavedTheme() {
                let savedTheme = localStorage.getItem('theme');
                let moonIcon = document.getElementById('moon-icon');
                let sunIcon = document.getElementById('sun-icon');
                let htmlElement = document.documentElement;

                if (savedTheme === 'dark') {
                    htmlElement.classList.add('dark');
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                } else {
                    htmlElement.classList.remove('dark');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            }

            // Apply the saved theme when the page loads
            document.addEventListener('DOMContentLoaded', applySavedTheme);
        </script>

    </body>
</html>
