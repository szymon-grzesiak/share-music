<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-fit mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg table-view-wrapper">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    @can('create', App\Models\Album::class)
                        <x-wireui-button primary
                                         label="{{ __('albums.actions.create') }}"
                                         href="{{ route('albums.create') }}"
                                         class="justify-self-end bg-blue-300 hover:bg-blue-500" />
                    @endcan
                </div>
                <livewire:albums.albums-table-view />
            </div>
        </div>
    </div>
</x-app-layout>

