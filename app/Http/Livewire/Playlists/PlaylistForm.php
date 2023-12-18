<?php

namespace App\Http\Livewire\Playlists;

use Livewire\Component;
use App\Models\Song;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PlaylistForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Song $song;
    public Bool $editMode;

    public function rules()
    {
        return [
            'song.title' => [
                'required',
                'string',
                'min:2',
                'unique:albums,name' .
                ($this->editMode
                    ? (',' . $this->album->id)
                    : ''
                ),
            ],
            'album.album_cover' => 'nullable|string|max:1024'
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(
                __('albums.attributes.name')
            ),
            'album_cover' => Str::lower(
                __('albums.attributes.album_cover')
            ),
        ];
    }

    public function mount(Album $album, Bool $editMode)
    {
        $this->album = $album;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.albums.album-form');
    }

    /**
     * Walidacja na żywo
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        sleep(1);   // tymczasowo, celem pokazania opóźnienia
        if ($this->editMode) {
            $this->authorize('update', $this->album);
        } else {
            $this->authorize('create', Album::class);
        }
        $this->validate();
        $this->album->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('albums.messages.successes.updated', ['name' => $this->album->name])
                : __('albums.messages.successes.stored', ['name' => $this->album->name])
        );
        $this->editMode = true;
        // opcjonalne przekierowanie na inny adres URL
        // return redirect()->route('genres.index');
    }
}
