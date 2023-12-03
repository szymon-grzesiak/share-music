<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.genres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-fit mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg table-view-wrapper">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    @can('create', App\Models\Song::class)
                        <x-wireui-button primary
                                         label="{{ __('songs.actions.create') }}"
                                         href="{{ route('songs.create') }}"
                                         class="justify-self-end bg-blue-300 hover:bg-blue-500" />
                    @endcan
                </div>
                <livewire:songs.songs-table-view />
            </div>
        </div>
    </div>
</x-app-layout>

