@props([
'album_cover' => '',
'name' => '',
'created_at' => '',
'release_date' => '',
'artist' => '',
'withBackground' => false,
'model',
'actions' => [],
'hasDefaultAction' => false,
'selected' => false
])

<div class="w-fit rounded-3xl glassmorphism{{ $withBackground ? 'rounded-4xl shadow-2xl' : '' }}">
    @if ($hasDefaultAction)
        <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
            <img src="{{ $album_cover }}" alt="{{ $album_cover }}" class="hover:shadow-lg cursor-pointer rounded-t-md w-[300px] h-[300px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
        </a>
    @else
        <img src="{{ $album_cover }}" alt="{{ $album_cover }}" class="rounded-t-3xl w-[300px] h-[300px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
    @endif

    <div class="p-4 pb-6">
        @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
                {!! $name !!}
            </a>
        @else
            <div class="font-bold text-lg" title="{{ $name }}">
                {{ strlen($name) > 26 ? substr($name, 0, 26) . '...' : $name }}
            </div>
        @endif
            <div class="flex justify-between items-center">
                <div>{{$artist}}</div>
                <div class="text-sm text-gray-500">{{ $release_date }}</div>
            </div>



            @if (count($actions))
                <div class="flex justify-end items-center">
                    <x-lv-actions.drop-down :actions="$actions" :model="$model" />
                </div>
            @endif
    </div>

</div>
