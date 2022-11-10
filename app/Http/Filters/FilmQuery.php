<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class FilmQuery extends QueryFilter
{
    public function genres(array $genres): Builder
    {
        return $this->builder->whereHas('genres', function (Builder $query) use ($genres) {
            $query->whereHas('genre', function (Builder $subQuery) use ($genres) {
                $subQuery->whereIn('value', $genres);
            });
        });
    }

    public function statuses(array $statuses): Builder
    {
        return $this->builder->whereHas('status', function (Builder $query) use ($statuses) {
            $query->whereIn('value', $statuses);
        });
    }

    public function type(string $type): Builder
    {
        return $this->builder->whereHas('type', function (Builder $query) use ($type) {
            $query->where('value', $type);
        });
    }

    public function years(array $years): Builder
    {
        return $this->builder->where([
            ['year', '>=', $years[0]],
            ['year', '<=', $years[1]]
        ]);
    }

    public function rating(string $rating): Builder
    {
        return $this->builder->orderBy('rating', $rating);
    }

    public function title(string $title): Builder
    {
        return $this->builder->orderBy('title', $title);
    }
}
