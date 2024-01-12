<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('translation.navigation.songs') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[rgb(18,18,18)]">
        <div class="w-full mx-auto pr-14">
            @can('create', App\Models\Song::class)
                <a
                    title="Dodaj piosenkę"
                    href="{{ route('songs.create') }}"
                    class="buttonStyle flex justify-center items-center text-3xl rounded-full fixed bottom-0 right-0 mr-2 mb-[100px] w-12 h-12" >
                    +
                </a>
            @endcan
                <div class="glassy">
                <div class="sm:rounded-lg glassmorphismTable">
                    <livewire:songs.songs-table-view />
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        document.querySelectorAll('.play-button').forEach(button => {--}}
{{--            button.addEventListener('click', function () {--}}
{{--                let songUrl = this.getAttribute('data-song-url');--}}
{{--                console.log(songUrl); // Dodaj to, aby zobaczyć URL w konsoli--}}
{{--                let audio = new Audio(songUrl);--}}
{{--                audio.play().catch(e => console.error(e)); // Dodaj obsługę błędów--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}


