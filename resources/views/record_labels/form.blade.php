<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.record_labels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                @if (isset($record_label))
                    <livewire:record_labels.record_labels-form :genre="$record_label" :editMode="true" />
                @else
                    <livewire:record_labels.record_labels-form :editMode="false" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

