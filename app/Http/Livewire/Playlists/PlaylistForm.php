<?php

namespace App\Http\Livewire\Playlists;

use App\Models\Playlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Album;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PlaylistForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public Playlist $playlist;
    public $image;

    public $imageUrl;
    public $imageExists;
    public Bool $editMode;

    public function rules()
    {
        $rules = [
            'playlist.name' => 'required|string|min:2',
            'playlist.description' => 'nullable|string|min:2',
            'playlist.user_id' => 'nullable|integer|exists:users,id',
        ];


        return $rules;
    }


    public function validationAttributes()
    {
        return [
            'name' => Str::lower(
                __('albums.attributes.name')
            ),
            'description' => Str::lower(
                __('albums.attributes.description')
            ),
            'user_id' => Str::lower(
                __('albums.attributes.user_id')
            ),
        ];
    }

    public function mount(Playlist $playlist, Bool $editMode)
    {
        $this->playlist = $playlist;
        $this->imageChange();
        $this->editMode = $editMode;

        if (!$editMode) {
            $this->playlist->user_id = auth()->id();
        }
    }

    public function render()
    {
        return view('livewire.playlists.playlist-form');
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
            $this->authorize('update', $this->playlist);
        } else {
            $this->authorize('create', Playlist::class);
        }

        $this->validate();

        $playlist = $this->playlist;
        $image = $this->image;

        DB::transaction(function () use ($playlist, $image) {
            $playlist->save();
            if ($image !== null) {
                $playlist->image = $playlist->id
                    . '.' . $this->image->getClientOriginalExtension();
                $playlist->save();
            }
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->playlist->image,
                'public'
            );
        }

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('albums.messages.successes.updated', ['name' => $this->playlist->name])
                : __('albums.messages.successes.stored', ['name' => $this->playlist->name])
        );
        $this->editMode = true;
        $this->imageChange();
    }

    public function confirmDeleteImage()
    {
        $this->dialog()->confirm([
            'title' => __('albums.dialogs.image_delete.title'),
            'description' => __('albums.dialogs.image_delete.description', [
                'name' => $this->playlist->name
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
        if (Storage::disk('public')->delete($this->playlist->image)) {
            $this->playlist->image = null;
            $this->album->save();
            $this->imageChange();
            $this->notification()->success(
                $title = __('translation.messages.successes.destroyed_title'),
                $description = __('albums.messages.successes.image_deleted', [
                    'name' => $this->playlist->name
                ])
            );
            return;
        }
        $this->notification()->error(
            $title = __('translation.messages.errors.destroy_title'),
            $description = __('albums.messages.errors.image_deleted', [
                'name' => $this->playlist->name
            ])
        );
    }

    protected function imageChange()
    {
        $this->imageExists = $this->playlist->imageExists();
        $this->imageUrl = $this->playlist->imageUrl();
    }
}
