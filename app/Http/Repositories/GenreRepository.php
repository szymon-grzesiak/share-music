<?php

namespace App\Http\Repositories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GenreRepository
{
    public function select(string|null $search, array|null $selected): Collection
    {
        return Genre::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $search,
                fn (Builder $query) => $query->where('name', 'like', "%{$search}%")
            )
            ->when(
                $selected,
                fn (Builder $query) => $query->whereIn(
                    'id',
                    array_map(
                        fn (array $item) => $item['id'],
                        array_filter(
                            $selected,
                            fn ($item) => (is_array($item) && isset($item['id']))
                        )
                    )
                ),
                fn (Builder $query) => $query
            )
            ->get();
    }
}
