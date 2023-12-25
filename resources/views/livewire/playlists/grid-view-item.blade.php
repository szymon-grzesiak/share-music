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

<div class="w-fit p-4 rounded-xl playlistGlassmorphism{{ $withBackground ? 'shadow-2xl' : '' }}">
    @if ($hasDefaultAction)
    <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
        <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-t-md w-[150px] h-[150px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
    </a>
    @else
        <a title="{{ $name }}" href="{{ route('playlists.songs', ['playlist' => $model->id]) }}" >
            <img src="{{ $image }}" alt="{{ $image }}" class="rounded-md mb-4 w-[150px] h-[150px] object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
        </a>
    @endif

    <div class="">
        @if ($hasDefaultAction)
        <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
            {!! $name !!}
        </a>
        @endif
        @if (count($actions) && (Auth::user()->hasRole('admin') ||$model->user_id === auth()->id()))
            <div class="flex [&:svg]:bg-white justify-end items-center absolute top-[-5px] right-0">
                <x-lv-actions.drop-down :actions="$actions" :model="$model" />
            </div>
        @endif
        <a title="{{ $name }}"  class="font-bold dark:text-dark-200 text-white text-lg hover:underline hover:cursor-pointer" href="{{ route('playlists.songs', ['playlist' => $model->id]) }}" >
            {{ strlen($model->name) > 26 ? substr($model->name, 0, 26) . '...' : $model->name }}
        </a>
        <div class="flex justify-between items-center">
            <div class="dark:text-gray-500 text-[rgb(160,160,160)]">{{ strlen($user) > 15 ? substr($user, 0, 15) . '...' : $user }}</div>
        </div>
    </div>

</div>
