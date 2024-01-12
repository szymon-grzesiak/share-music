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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                <header id="headerId" class="shadow" style="background-color: rgb(18,18,18)">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <div class="flex">
                <aside class="bg-[rgb(18,18,18)] sticky left-0 top-0 h-screen overflow-y-auto p-6 pt-12 w-full max-w-[300px]">
                    <h2 class="text-white text-2xl mb-10">Biblioteka</h2>
                    <div class="pb-[90px]">
                        <ul class="flex flex-col gap-4">
                            @foreach ($playlists as $playlist)
                                @if (Auth::user()->id == $playlist->user_id)
                                    <li>
                                        <a class="hover:bg-white/10 text-white flex justify-start items-center gap-x-4" href="{{ route('playlists.songs', ['playlist' => $playlist->id]) }}" >
                                            <img class="w-[60px] h-[60px]" src="{{str_contains($playlist->image, 'http') ?  $playlist->image : $playlist->imageUrl()}}" alt="{{$playlist->name}}"/>
                                            <span>{{ strlen($playlist->name) > 15 ? substr($playlist->name, 0, 15) . '...' : $playlist->name }}</span>
                                        </a>
                                    </li>
                                @elseif (Auth::user()->hasRole('admin'))
                                    <li>
                                        <a class="hover:bg-white/10 text-white flex justify-start items-center gap-x-4" href="{{ route('playlists.songs', ['playlist' => $playlist->id]) }}" >
                                            <img class="w-[60px] h-[60px]" src="{{str_contains($playlist->image, 'http') ?  $playlist->image : $playlist->imageUrl()}}" alt="{{$playlist->name}}"/>
                                            <span>{{ strlen($playlist->name) > 15 ? substr($playlist->name, 0, 15) . '...' : $playlist->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </aside>
                <main class="w-full mb-[87px]">
                    {{ $slot }}
                </main>
                <div class="fixed bottom-0 bg-black w-full flex justify-between p-3 pt-4">
                    <div class="about flex justify-start items-center gap-x-3 w-1/3">
                        <img src="" alt="img" class="cover rounded-md w-[60px] h-[60px]"/>
                        <div class="flex flex-col gap-1">
                            <h1 class="track-title text-white text-sm"></h1>
                            <span class="artist-name text-gray-400 text-xs"></span>
                        </div>

                    </div>
                    <div class="controls w-1/3">
                        <div class="flex items-center justify-center gap-6 h-fit">
                            <button class="btnPlayer" id="btnPrev">
                                 <span class="material-symbols-outlined">
                            fast_rewind
                        </span>
                            </button>
                            <button class="btnPlayer btn-main" id="mainPlayBtn">
                        <span class="material-symbols-outlined ">
                            play_arrow
                        </span>
                            </button>
                            <button class="btnPlayer" id="btnNext">
                            <span class="material-symbols-outlined ">
                            fast_forward
                        </span>
                            </button>
                        </div>
                        <div class="timeline flex justify-between items-center gap-x-3 w-full">
                            <small class="time text-gray-400">0:00</small>
                            <div class="range-slider">
                                <input type="range" min="0" max="100" value="0" class="slider"/>
                                <div class="slider-thumb"></div>
                                <div class="progress"></div>
                            </div>
                            <small class="fulltime text-gray-400">2:55</small>
                        </div>

                    </div>
                    <div class="volume-slider w-1/3 mr-4">
                        <div class="flex justify-end">
                            <div class="volume-icon">
                        <span class="material-symbols-outlined spanSmall">
                            volume_down
                        </span>
                            </div>
                            <div class="range-slider">
                                <input type="range" min="0" max="100" value="50" class="slider"/>
                                <div class="volume-thumb"></div>
                                <div class="progress"></div>
                            </div>
                            <audio id="audio" class="hidden">
                                <source src="" type="audio/mpeg"/>
                            </audio>
                        </div>
                    </div>

                </div>
            </div>
            </div>


        @stack('modals')
        @livewireScripts
        @laravelViewsScripts('laravel-views')
        <script>
            window.songsData = @json($songs);
            console.log(window.songsData);

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

            document.addEventListener('DOMContentLoaded', applySavedTheme);

            const playBtn = document.querySelector('#mainPlayBtn');
            const audio = document.querySelector('#audio');
            const btnPrev = document.querySelector('#btnPrev');
            const btnNext = document.querySelector('#btnNext');
            const trackTitle = document.querySelector('.track-title');
            const artistName = document.querySelector('.artist-name');
            const cover = document.querySelector('.cover');
            const slider = document.querySelector('.slider');
            const thumb = document.querySelector('.slider-thumb');
            const progress = document.querySelector('.progress');
            const time = document.querySelector('.time');
            const fullTime = document.querySelector('.fulltime');
            const volumeSlider = document.querySelector('.volume-slider .slider');
            const volumeProgress = document.querySelector('.volume-slider .progress');
            const volumeIcon = document.querySelector('.volume-icon');
            const volumeThumb = document.querySelector('.volume-thumb');

            // Global variables
            let trackPlaying = false;
            let volumeMuted = false;

            let playHistory = [];
            let currentHistoryIndex = -1; // -1 oznacza, że żaden utwór nie jest obecnie odtwarzany

            let trackId = 0;

            const songs = window.songsData.map(song => song.title);
            const artists = window.songsData.map(song => song.user.name);
            const covers = window.songsData.map(song => song.album.album_cover);

             playBtn.addEventListener('click', playTrack);

             function forcePlay() {
                 audio.play();
                 playBtn.innerHTML = `
                         <span class="material-symbols-outlined">
                             pause
                         </span>
                     `;
                 trackPlaying = true;
             }

             function playTrack() {
                 if (!trackPlaying) {
                     audio.play();
                     playBtn.innerHTML = `
                         <span class="material-symbols-outlined">
                             pause
                         </span>
                     `;
                     trackPlaying = true;
                 } else {
                     audio.pause();
                     playBtn.innerHTML = `
                         <span class="material-symbols-outlined">
                             play_arrow
                         </span>
                     `;
                     trackPlaying = false;
                 }
             }

              function switchTrack() {
                 audio.play();
              }

              const trackSrc = window.songsData.map(song => song.song_file);

            function loadTrack(track) {
                audio.src = track.song_file;
                audio.load();

                trackTitle.textContent = track.title;
                artistName.textContent = track.user.name;
                cover.src = track.album.album_cover;

                progress.style.width = 0;
                thumb.style.left = 0;

                audio.addEventListener('loadeddata', function() {
                    setTime(fullTime, audio.duration);
                    slider.setAttribute('max', audio.duration);
                });
            }
            loadTrack(window.songsData[0]);


             btnPrev.addEventListener('click', () => {
                 if (currentHistoryIndex > 0) {
                     currentHistoryIndex--;
                     const previousTrackId = playHistory[currentHistoryIndex];
                     const track = window.songsData.find(song => song.id === previousTrackId);
                     loadTrack(track);
                     playTrack();
                 } else {
                     console.log('To jest pierwszy utwór w historii odtwarzania.');
                 }
             })

            btnNext.addEventListener('click', nextTrack);

             function nextTrack() {
                 const randomIndex = Math.floor(Math.random() * window.songsData.length);
                 const randomTrack = window.songsData[randomIndex];

                 addToPlayHistory(randomTrack.id);

                 loadTrack(randomTrack);
                 switchTrack();
             }

             audio.addEventListener('ended', nextTrack);

             function setTime(output, input) {
                    let minutes = Math.floor(input / 60);
                    let seconds = Math.floor(input % 60);

                    if(seconds < 10) {
                        output.innerHTML = minutes + ':0' + seconds;
                    } else {
                        output.innerHTML = minutes + ':' + seconds;
                    }
             }
            setTime(fullTime, audio.duration);

             audio.addEventListener('timeupdate', function() {
                const currentAudioTime = Math.floor(audio.currentTime);
                const timePercentage = (currentAudioTime / audio.duration) * 100 + "%";
                setTime(time, currentAudioTime);
                progress.style.width = timePercentage;
                thumb.style.left = timePercentage;
             });

             function customSlider() {
                 const val = (slider.value / audio.duration) * 100 + '%';
                 progress.style.width = val;
                 thumb.style.left = val;

                 setTime(time, slider.value);
                 audio.currentTime = slider.value;
             }

             customSlider();

             slider.addEventListener('input', customSlider);

             let val;

             function customVolumeSlider() {
                 const maxVal = volumeSlider.getAttribute('max');
                    val = (volumeSlider.value / maxVal) * 100 + '%';
                    volumeProgress.style.width = val;
                    volumeThumb.style.left = val;
                    audio.volume = volumeSlider.value / maxVal;

                    if(audio.volume > 0.5) {
                        volumeIcon.innerHTML = `
                            <span class="material-symbols-outlined">
                                volume_up
                            </span>
                        `;
                    } else if(audio.volume < 0.5 && audio.volume > 0) {
                        volumeIcon.innerHTML = `
                            <span class="material-symbols-outlined">
                                volume_down
                            </span>
                        `;
                    } else if(audio.volume === 0) {
                        volumeIcon.innerHTML = `
                            <span class="material-symbols-outlined">
                                volume_off
                            </span>
                        `;
                    }
             }
             customVolumeSlider();

            volumeSlider.addEventListener('input', customVolumeSlider);

            volumeIcon.addEventListener('click', () => {
                if(volumeMuted === false) {
                  volumeIcon.innerHTML = `
                            <span class="material-symbols-outlined">
                                volume_off
                            </span>
                        `;
                    audio.volume = 0;
                    volumeProgress.style.width = 0;
                    volumeThumb.style = 'display: none';
                    volumeMuted = true;
                } else {
                    volumeIcon.innerHTML = `
                            <span class="material-symbols-outlined">
                                volume_up
                            </span>
                        `;
                    audio.volume = 0.5;
                    volumeProgress.style.width = val;
                    volumeThumb.style = 'display: block';
                    volumeThumb.style.left = val;
                    volumeMuted = false;
                }
            });
            function playSongById(trackId) {
                const track = window.songsData.find(song => song.id === trackId);
                if (track) {
                    playHistory.push(trackId);
                    currentHistoryIndex = playHistory.length - 1;

                    loadTrack(track);
                    forcePlay();
                }
            }

            document.addEventListener('click', function(event) {
                if (event.target.matches('button[data-id]')) {
                    const trackId = parseInt(event.target.getAttribute('data-id'));
                    playSongById(trackId);
                }
            });

            function addToPlayHistory(trackId) {
                const track = window.songsData.find(song => song.id === trackId);
                if (track) {
                    playHistory.push(track.id);
                    currentHistoryIndex = playHistory.length - 1;
                }
            }

        </script>

    </body>
</html>
