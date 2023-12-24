@php
    $user = auth()->user(); // Załaduj aktualnie zalogowanego użytkownika
    $playlists = \App\Models\Playlist::where('user_id', $user->id)->get();
@endphp

<x-wireui-dropdown>
    <x-label>
        <div>Wybierz playliste : </div>
    </x-label>
    <x-slot name="trigger">
        <button class="btn"><i data-feather="more-horizontal"></i></button>
    </x-slot>

    @forelse ($playlists as $playlist)
        <x-wireui-dropdown.item label="{{ $playlist->name }}" wire:click="addSongToPlaylist({{ $selectedSongId }}, {{ $playlist->id }})" />
    @empty
        <x-wireui-dropdown.item label="No playlists available" disabled />
    @endforelse
</x-wireui-dropdown>
