<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('translation.navigation.songs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="sm:rounded-lg table-view-wrapper">
                    @can('create', App\Models\Song::class)
                        <x-wireui-button primary
                                         label="+"
                                         title="Dodaj piosenkę"
                                         href="{{ route('songs.create') }}"
                                         class="justify-self-end text-3xl bg-blue-300 hover:bg-blue-500 rounded-full fixed bottom-0 left-0 ml-10 mb-6 w-14 h-14" />
                    @endcan
                <livewire:songs.songs-table-view />
            </div>
        </div>
    </div>
</x-app-layout>

