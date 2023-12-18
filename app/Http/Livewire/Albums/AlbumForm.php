<?php

namespace App\Http\Livewire\Albums;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Album;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AlbumForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public Album $album;
    public $album_cover;

    // atrybuty pomocnicze nie bindowane bezpośrednio w formularzu
    public $imageUrl;
    public $imageExists;
    public Bool $editMode;

    public function rules()
    {
        $rules = [
            'album.name' => 'required|string|min:2',
            'album.release_date' => 'nullable|date',
            'album.artist_id' => 'nullable|integer|exists:users,id',
        ];


        return $rules;
    }


    public function validationAttributes()
    {
        return [
            'name' => Str::lower(
                __('albums.attributes.name')
            ),
            'release_date' => Str::lower(
                __('albums.attributes.release_date')
            ),
            'artist_id' => Str::lower(
                __('albums.attributes.artist_id')
            ),
            'album_cover' => Str::lower(
                __('albums.attributes.album_cover')
            ),
        ];
    }

    public function mount(Album $album, Bool $editMode)
    {
        $this->album = $album;
        $this->imageChange();
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
        // autoryzacja poprzez policy
        if ($this->editMode) {
            $this->authorize('update', $this->album);
        } else {
            $this->authorize('create', Album::class);
        }

        $this->validate();

        $album = $this->album;
        $album_cover = $this->album_cover;

        DB::transaction(function () use ($album, $album_cover) {
            $album->save();
            if ($album_cover !== null) {
                $album->album_cover = $album->id
                    . '.' . $this->album_cover->getClientOriginalExtension();
                $album->save();
            }
        });

        if ($this->album_cover !== null) {
            $this->album_cover->storeAs(
                '',
                $this->album->album_cover,
                'public'
            );
        }

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('albums.messages.successes.updated', ['name' => $this->album->name])
                : __('albums.messages.successes.stored', ['name' => $this->album->name])
        );
        $this->editMode = true;
        $this->imageChange();
    }

    public function confirmDeleteImage()
    {
        $this->dialog()->confirm([
            'title' => __('albums.dialogs.image_delete.title'),
            'description' => __('albums.dialogs.image_delete.description', [
                'name' => $this->album->name
            ]),
            'icon' => 'question',
            'iconColor' => __('translation.no'),
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'deleteImage',
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }
    public function deleteImage()
    {
        if (Storage::disk('public')->delete($this->album->album_cover)) {
            $this->album->album_cover = null;
            $this->album->save();
            $this->imageChange();
            $this->notification()->success(
                $title = __('translation.messages.successes.destroyed_title'),
                $description = __('albums.messages.successes.image_deleted', [
                    'name' => $this->album->name
                ])
            );
            return;
        }
        $this->notification()->error(
            $title = __('translation.messages.errors.destroy_title'),
            $description = __('albums.messages.errors.image_deleted', [
                'name' => $this->album->name
            ])
        );
    }

    protected function imageChange()
    {
        $this->imageExists = $this->album->imageExists();
        $this->imageUrl = $this->album->imageUrl();
    }
}
