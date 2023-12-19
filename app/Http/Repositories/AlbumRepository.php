<?php

namespace App\Http\Repositories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AlbumRepository
{
    public function select(string|null $search, array|null $selected): Collection
    {
        $userId = Auth::id();

        return Album::query()
            ->select('id', 'name')
            ->where('artist_id', $userId)
            ->orderBy('name')
            ->when(
                $search,
                fn (Builder $query) => $query->where('name', 'like', "%{$search}%")
            )
            ->when(
                $selected,
                fn (Builder $query) => $query->whereIn('id', $selected),
                fn (Builder $query) => $query
            )
            ->get();
    }
}
