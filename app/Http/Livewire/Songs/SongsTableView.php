<?php

namespace App\Http\Livewire\Songs;

use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Songs\Actions\AddSongToPlaylistInlineAction;
use App\Http\Livewire\Songs\Actions\AddToPlaylistAction;
use App\Http\Livewire\Songs\Actions\EditSongAction;
use App\Http\Livewire\Songs\Actions\RestoreSongAction;
use App\Http\Livewire\Songs\Actions\SoftDeletesSongAction;
use App\Http\Livewire\Songs\Filters\InputAlbumFilter;
use App\Http\Livewire\Songs\Filters\InputArtistFilter;
use App\Http\Livewire\Songs\Filters\InputGenreFilter;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDeletes;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use WireUi\Traits\Actions;

class SongsTableView extends TableView
{
    use Actions;
    use SoftDeletes;
    use Restore;

    protected $model = Song::class;

    public $playlists;
    public $selectedSongId;

    public bool $showModal = false;



    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'title',
        'duration',
        'genres.name',
        'user.name',
        'album.name'
    ];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return bool Eloquent query
     */


    public function toggleModal()
    {
        return $this->showModal = !$this->showModal;
    }


    public function repository(): Builder
    {
        $query = Song::query()
            ->with(['album', 'genres', 'user'])
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->select('songs.*', 'albums.name as album_name');

        if (request()->user()->hasRole('admin')) {
            $query->withTrashed();
        }


        return $query;
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('albums.attributes.album_cover')),
            Header::title('Nazwa albumu')->sortBy('albums.name'),
            Header::title(__('songs.attributes.title'))->sortBy('songs.title'),
            Header::title('🕐')->sortBy('songs.duration'),
            Header::title('Gatunek'),
            Header::title(__('users.attributes.name')),
            Header::title('Dodaj'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $seconds = floor($model->duration / 1000);
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;

        $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds);

        return [
            $model->album ? '<img class="w-14 h-14 mx-auto" src="' . $model->album->album_cover . '" alt="Album Cover" />' : 'No Cover',
            $model->album ? '<span class="hover:underline"><a href="albums?sortOrder=asc&search=' . $model->album->name . '">' . (strlen($model->album->name) > 15 ? substr($model->album->name, 0, 15) . '...' : $model->album->name) . '</a></span>' : 'No Album',
            'title' => '<span title="' . htmlspecialchars($model->title) . '">' . (strlen($model->title) > 15 ? substr($model->title, 0, 15) . '...' : $model->title) . '</span>',
            'duration' => $formattedDuration,
            'genres' => $model->genres->implode('name', ', '),
            $model->user ? '<span class="hover:underline"><a href="albums?sortOrder=asc&filters[input-user-filter]=' . $model->user->name . '">' . $model->user->name . '</a></span>' : 'No User',
            'actions' => view('components.add-song-to-playlist-button', [
                'selectedSongId' => $model->id,
                'showModal' => $this->showModal,

            ])->render(),
        ];

    }

    public function addSongToPlaylist($songId, $playlistId)
    {


//        DB::table('playlist_song')->insert([
//            'song_id' => $songId,
//            'playlist_id' => $playlistId,
//        ]);
//        $this->emit('alert', 'Song added to the playlist.');


        if (!Auth::check()) {
            $this->emit('alert', 'You need to be logged in.');
            return;
        }

        $userId = Auth::id();

        // Check if the show is already in the watchlist
        $exists = DB::table('playlist_song')
            ->where('song_id', $songId)
            ->where('playlist_id', $playlistId)
            ->exists();

        if ($exists) {
            // If it exists, remove it from the watchlist
            DB::table('playlist_song')
                ->where('song_id', $songId)
                ->where('playlist_id', $playlistId)
                ->delete();

            $this->notification()->success(
                $title = 'Usunięto',
                $description = 'Właśnie usunąłeś piosenkę z playlisty'
            );        } else {
            // If it doesn't exist, add it to the watchlist
            DB::table('playlist_song')->insert([
                'song_id' => $songId,
                'playlist_id' => $playlistId,
            ]);

            $this->notification()->success(
                $title = 'Dodano',
                $description = 'Właśnie dodałeś piosenkę do playlisty'
            );        }
    }


    /**
     * Set filters
     */
    protected function filters()
    {
        return [
            new SoftDeletedFilter,
            new InputGenreFilter,
            new InputAlbumFilter,
            new InputArtistFilter
        ];
    }

    /** Actions by item */
    protected function actionsByRow()
    {
        return [
            new EditSongAction(
                'songs.edit',
                __('songs.actions.edit')
            ),
            new SoftDeletesSongAction(),
            new RestoreSongAction(),
        ];

    }

    public function softDeletes(int $id)
    {
        $song = Song::find($id);
        $song->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('categories.messages.successes.destroyed', [
                'name' => $song->name
            ])
        );
    }

    protected function softDeletesNotificationDescription(Model $model)
    {
        return __('songs.messages.successes.destroyed', [
            'name' => $model->name
        ]);
    }

    protected function restoreNotificationDescription(Model $model)
    {
        return __('songs.messages.successes.restored', [
            'name' => $model->name
        ]);
    }
}
