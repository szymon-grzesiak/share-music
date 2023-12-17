<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
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
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="artist_id">{{ __('albums.attributes.artist') }}</label>
            </div>
            <div class="">
                <x-wireui-select placeholder="{{ __('translation.select') }}" wire:model.defer="album.artist_id"
                                 :async-data="route('async.artists')" option-label="name" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="release_date">{{ __('albums.attributes.release_date') }}</label>
            </div>
            <div class="">
                <x-wireui-datetime-picker
                    without-time="true"
                    placeholder="{{ __('translation.enter') }}"
                    wire:model="album.release_date"
                />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="album_cover">{{ __('albums.attributes.album_cover') }}</label>
            </div>
            <div class="">
                @if ($imageExists || $album->album_cover !== null)
                    <div class="relative">
                        <img class="w-[300px] h-[300px]" src="{{str_contains($album->album_cover, 'http') ?  $album->album_cover : $album->imageUrl() }}" alt="{{ $album->name }}">
                        <div class="absolute right-2 top-2 h-16">
                            <x-wireui-button.circle outline xs secondary icon="trash"
                                                    wire:click="confirmDeleteImage" />
                        </div>
                    </div>
                @else
                    <x-wireui-input accept="image/*" type="file" wire:model="album_cover" />
                @endif
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('albums.index') }}" secondary class="mr-2"
                             label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>
