<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{$album->name}}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg table-view-wrapper">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    @can('create', App\Models\Album::class)
                        <x-wireui-button primary
                                         label="{{ __('genres.actions.create') }}"
                                         href="{{ route('genres.create') }}"
                                         class="justify-self-end bg-blue-300 hover:bg-blue-500" />
                    @endcan
                </div>
                <livewire:albums.specific-album-table-view :album-id="$album->id" />
            </div>
        </div>
    </div>
</x-app-layout>

