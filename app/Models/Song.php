<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'duration'
    ];
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    protected function file(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === null) {
                    return null;
                }
                return config('filesystems.files_dir') . '/' . $value;
            },
        );
    }

    public function fileUrl(): string
    {
        return $this->fileExists()
            ? Storage::url($this->song_file)
            : Storage::url(
                config('filesystems.default_file')
            );
    }

    /**
     * Sprawdza, czy plik muzyczny istnieje.
     *
     * @return bool
     */
    public function fileExists(): bool
    {
        return $this->file !== null && Storage::disk('public')->exists($this->file);
    }

}
