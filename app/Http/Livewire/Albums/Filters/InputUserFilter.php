<?php

namespace App\Http\Livewire\Albums\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

/**
 * Filtr użytkownika
 */
class InputUserFilter extends Filter
{
    public $type = 'input';
    public $view = 'input-filter';
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('albums.filters.users');
    }

    /**
     * Zastosowanie filtra
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('user', function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        });
    }
}
