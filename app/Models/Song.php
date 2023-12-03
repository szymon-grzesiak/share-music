<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function record_label()
    {
        return $this->belongsTo(RecordLabel::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'artist_id');
    }
}
