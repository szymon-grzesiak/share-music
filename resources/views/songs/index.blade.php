<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('translation.navigation.songs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto pr-14">
            <div class="sm:rounded-lg table-view-wrapper">
                    @can('create', App\Models\Song::class)
                        <a
                            title="Dodaj piosenkę"
                            href="{{ route('songs.create') }}"
                            class="buttonStyle flex justify-center items-center text-3xl rounded-full fixed bottom-0 right-0 mr-2 mb-6 w-12 h-12" >
                           +
                        </a>
                    @endcan
                        <livewire:songs.songs-table-view />
            </div>
        </div>
    </div>
</x-app-layout>



