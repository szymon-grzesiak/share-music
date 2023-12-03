<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($editMode)
                {{ __('albums.labels.edit_form_title') }}
            @else
                {{ __('albums.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('albums.attributes.name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="album.name" />
            </div>
            <div class="">
                <label for="album_cover">{{ __('albums.attributes.album_cover') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="album.album_cover" />
            </div>
            <div class="">
                <label for="description">{{ __('albums.attributes.description') }}</label>
            </div>
            <div class="">
                <x-wireui-textarea placeholder="{{ __('translation.enter') }}" wire:model="album.description" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('albums.index') }}" secondary class="mr-2 bg-blue-200" label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" class="bg-blue-300" spinner />
        </div>
    </form>
</div>
