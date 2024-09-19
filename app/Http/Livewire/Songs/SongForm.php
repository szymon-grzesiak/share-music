<?php

namespace App\Http\Livewire\Songs;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Song;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SongForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Song $song;
    public $genresIds;

    public Bool $editMode;

    public function rules()
    {
        return [
            'song.title' => [
                'required',
                'string',
                'min:2',
            ],
            'song.duration' => [
                'required',
                'string',
            ],
            'song.artist_id' => 'nullable|integer|exists:users,id',
            'song.album_id' => 'nullable|integer|exists:albums,id',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(
                __('albums.attributes.name')
            ),
            'duration' => Str::lower(
                __('albums.attributes.duration')
            ),
            'artist_id' => Str::lower(
                __('albums.attributes.artist_id')
            ),
            'album_id' => Str::lower(
                __('albums.attributes.album_id')
            ),

        ];
    }

    public function mount(Song $song, Bool $editMode)
    {
        $this->song = $song;
        $this->genresIds = $this->song->genres->toArray();
        $this->editMode = $editMode;


        if (!$editMode) {
            $this->song->artist_id = auth()->id();
        }
    }

    public function render()
    {
        return view('livewire.songs.song-form');
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
        // autoryzacja poprzez policy
        if ($this->editMode) {
            $this->authorize('update', $this->song);
        } else {
            $this->authorize('create', Song::class);
        }

        $this->validate();
        $genresIds = $this->genresIds;
        $song = $this->song;

        DB::transaction(function () use ($song, $genresIds) {
            $song->save();
            $song->genres()->sync($genresIds);
        });


        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('albums.messages.successes.updated', ['name' => $this->song->title])
                : __('albums.messages.successes.stored', ['name' => $this->song->title])
        );
        $this->editMode = true;
    }
}
