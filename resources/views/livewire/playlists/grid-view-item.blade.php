@props([
'image' => '',
'description' => '',
'name' => '',
'user' => '',
'withBackground' => false,
'model',
'actions' => [],
'hasDefaultAction' => false,
'selected' => false
])

<div class="w-fit rounded-3xl glassmorphism{{ $withBackground ? 'rounded-4xl shadow-2xl' : '' }}">
    @if ($hasDefaultAction)
    <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
        <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-t-md w-[300px] h-[300px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
    </a>
    @else
    <img src="{{ $image }}" alt="{{ $image }}" class="rounded-t-3xl w-[300px] h-[300px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
    @endif

    <div class="p-4 pb-6">
        @if ($hasDefaultAction)
        <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
            {!! $name !!}
        </a>
        @else
        @endif
            <div class="font-bold text-lg hover:underline hover:cursor-pointer" title="{{ $name }}">
                <a href="{{ route('playlists.songs', ['playlist' => $model->id]) }}" >
                    {{ strlen($model->name) > 26 ? substr($model->name, 0, 26) . '...' : $model->name }}
                </a>
            </div>
        <div class="flex justify-between items-center">
            <div>{{$user}}</div>
        </div>

        @if (count($actions))
        <div class="flex justify-end items-center">
            <x-lv-actions.drop-down :actions="$actions" :model="$model" />
        </div>
        @endif
    </div>

</div>
