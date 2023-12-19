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
                <aside class="bg-[rgb(30,30,65)] sticky left-0 top-0 h-screen overflow-y-auto p-6 pt-12 w-[266px]">
                    <h2 class="text-white text-4xl">Biblioteka</h2>
                    <div>
                        <ul class="flex flex-col gap-4">
                            @foreach ($playlists as $playlist)
                                <a class="hover:bg-white/10" href="{{ route('playlists.songs', ['playlist' => $playlist->id]) }}" >

                                <li class="text-white flex justify-between items-center">
                                    <img class="w-[60px] h-[60px]" src="{{$playlist->image}}" alt="{{$playlist->name}}"/>
                                        <span>{{ strlen($playlist->name) > 26 ? substr($playlist->name, 0, 26) . '...' : $playlist->name }}</span>
                                </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </aside>
                <main class="w-full"> <!-- Adjust the margin-left to match the width of the aside -->
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
        @laravelViewsScripts('laravel-views')
    </body>
</html>
