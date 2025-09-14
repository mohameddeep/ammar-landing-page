<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{

    /**
     * Apply search on specified columns.
     *
     * @param  Builder  $query
     * @param  string|null  $term
     * @return Builder
     */
    public function scopeSearch($query, string $key = 'search')
    {
        $searchTerm = request()->get('search');
        if (empty($this->searchable) || ! $searchTerm) {
            return $query;
        }

        $query->where(function ($q) use ($searchTerm) {
            foreach ($this->searchable as $column) {
                if (Str::contains($column, '.')) {
                    [$relation, $field] = explode('.', $column);
                    $q->orWhereHas($relation, function ($query) use ($field, $searchTerm) {
                        $query->where($field, 'LIKE', '%'.$searchTerm.'%');
                    });
                } else {
                    $q->orWhere($column, 'LIKE', '%'.$searchTerm.'%');
                }

            }
        });

        return $query;
    }
}
