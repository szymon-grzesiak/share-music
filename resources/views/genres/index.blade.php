<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.genres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg table-view-wrapper">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    @can('create', App\Models\Genre::class)
                        <x-wireui-button primary
                                  label="{{ __('genres.actions.create') }}"
                                  href="{{ route('genres.create') }}"
                                  class="justify-self-end bg-blue-300" />
                    @endcan
                </div>
                <livewire:genres.genres-table-view />
            </div>
        </div>
    </div>
</x-app-layout>

