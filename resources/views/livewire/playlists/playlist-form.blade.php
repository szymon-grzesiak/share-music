<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ __('playlists.labels.edit_form_title') }}
            @else
                {{ __('playlists.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('playlists.attributes.name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="playlist.name" />
            </div>
        </div>
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">{{ __('playlists.attributes.name') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="playlist.description" />
            </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="image">{{ __('playlists.attributes.image') }}</label>
            </div>
            <div class="">
                @if ($imageExists || $playlist->image !== null)
                    <div class="relative">
                        <img class="w-[300px] h-[300px]" src="{{str_contains($playlist->image, 'http') ?  $playlist->image : $playlist->imageUrl() }}" alt="{{ $playlist->name }}">
                        <div class="absolute right-2 top-2 h-16">
                            <x-wireui-button.circle outline xs secondary icon="trash"
                                                    wire:click="confirmDeleteImage" />
                        </div>
                    </div>
                @else
                    <x-wireui-input accept="image/*" type="file" wire:model="image" />
                @endif
            </div>
        </div>

        <hr class="my-2">
        <div class="hidden">
            <div class="">
                <label for="user_id">{{ __('playlists.attributes.user') }}</label>
            </div>
            <div class="">
                <x-wireui-select placeholder="{{ __('translation.select') }}" wire:model.defer="playlist.user_id"
                                 :async-data="route('async.artists')" option-label="name" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('playlists.index') }}" secondary class="mr-2"
                             label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>
