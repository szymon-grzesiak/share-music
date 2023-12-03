@props([
'album_cover' => '',
'name' => '',
'created_at' => '',
'description' => '',
'withBackground' => false,
'model',
'actions' => [],
'hasDefaultAction' => false,
'selected' => false
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
    @if ($hasDefaultAction)
        <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
            <img src="{{ $album_cover }}" alt="{{ $album_cover }}" class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
        </a>
    @else
        <img src="{{ $album_cover }}" alt="{{ $album_cover }}" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
    @endif

    <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
        <div class="flex items-start">
            <div class="flex-1">
                <h3 class="font-bold leading-6 text-gray-900">
                    @if ($hasDefaultAction)
                        <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
                            {!! $name !!}
                        </a>
                    @else
                        {!! $name !!}
                    @endif
                </h3>
                <span class="text-sm text-gray-600 flex justify-end">

                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                            {{ $created_at->format('M d, Y') }}
                        </span>

        </span>
            </div>

            @if (count($actions))
                <div class="flex justify-end items-center">
                    <x-lv-actions.drop-down :actions="$actions" :model="$model" />
                </div>
            @endif
        </div>

        @if (isset($description))
            <p class="line-clamp-3 mt-2">
                {!! $description !!}
            </p>
        @endif
    </div>

</div>
