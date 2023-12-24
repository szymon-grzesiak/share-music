<?php

namespace App\Http\Livewire\Playlists;

use App\Http\Livewire\Playlists\Actions\DeleteSongFromPlaylistAction;
use App\Http\Livewire\Songs\Filters\InputAlbumFilter;
use App\Http\Livewire\Songs\Filters\InputArtistFilter;
use App\Http\Livewire\Songs\Filters\InputGenreFilter;
use App\Models\Album;
use App\Models\Playlist;
use App\Models\Song;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;


class SpecificPlaylistTableView extends TableView
{
    use Actions;

    public $playlistId;


    /**
     * Sets the searchable properties
     */
    public $searchBy = [
        'name',
    ];

    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Song::with(['album', 'user', 'genres'])
            ->whereHas('playlists', function ($query) {
                $query->where('playlists.id', $this->playlistId);
            });
    }


    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'Okładka Albumu',
            'Nazwa Albumu',
            'Tytuł',
            'Czas Trwania',
            'Gatunek',
            'Artysta',
            // Możesz dodać więcej nagłówków jeśli potrzebujesz
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

        $genreNames = $model->genres->pluck('name')->join(', ');

        return [
            $model->album ? '<img class="w-14 h-14 mx-auto" src="' . $model->album->album_cover . '" alt="Album Cover" />' : 'No Cover',
            $model->album ? '<span class="hover:underline"><a href="../albums?sortOrder=asc&search=' . $model->album->name . '">' . $model->album->name . '</a></span>' : 'No Album',
            'Tytuł' => $model->title,
            'Czas Trwania' => $formattedDuration,
            'Gatunek' => $genreNames,
            $model->user ? '<span class="hover:underline"><a href="../albums?sortOrder=asc&filters[input-user-filter]=' . $model->user->name . '">' . $model->user->name . '</a></span>' : 'No User'
        ];
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
           new DeleteSongFromPlaylistAction()
        ];
    }

 function deleteFromPlaylist($songId) {
     try {
         $playlist = Playlist::find($this->playlistId);
         $playlist->songs()->detach($songId);

         // Here we emit a notification instead of an alert
         $this->notification()->success(
             $title = 'Song removed',
             $description = 'The song was successfully removed from the playlist',
         );
     } catch (\Exception $e) {
         $this->notification()->error(
             $title = 'Error',
             $description = 'There was an error removing the song from the playlist'
         );
     }
    }

    public function softDeletes(int $id)
    {
        $album = Album::find($id);
        $album->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('albums.messages.successes.destroyed', [
                'name' => $album->name
            ])
        );
    }

    public function restore(int $id)
    {
        $album = Album::withTrashed()->find($id);
        $album->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('albums.messages.successes.restored', [
                'name' => $album->name
            ])
        );
    }
}
