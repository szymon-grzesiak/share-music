<?php
namespace App\Http\Livewire\Songs\Actions;

use App\Models\Song;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class AddToPlaylistAction extends Action
{
public $title = "Add to Playlist";

    public function handle($song, View $view)
    {
        $this->emit('openModalWithSong', ['song' => $song]);
    }

// Obsługa modala w Livewire
    public $selectedPlaylist;
    public $songToAdd;
    protected $listeners = ['openModalWithSong' => 'openModalWithSong'];


    public function openModalWithSong($data)
    {
        $this->songToAdd = Song::find($data['song']);
        $this->selectedPlaylist = null; // reset wybranej playlisty
        $this->emit('openModal', 'select-playlist-modal');
    }

    public function addToPlaylist()
    {
        $playlist = auth()->user()->playlists()->find($this->selectedPlaylist);

        if ($playlist) {
            if (!$playlist->songs->contains($this->songToAdd->id)) {
                $playlist->songs()->attach($this->songToAdd);
                $this->emit('closeModal', 'select-playlist-modal');
                $this->success('Piosenka dodana do playlisty');
            } else {
                $this->error('Piosenka jest już w playlisty');
            }
        } else {
            $this->error('Nie wybrano playlisty');
        }
    }
}
