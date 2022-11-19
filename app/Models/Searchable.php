<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

trait Searchable
{
    public function scopeFilter(Builder $query, array $filter){
        foreach ($filter as $key => $value) {
            if (in_array($key, $this->fillable) && !empty($value)) {
                $query->whereIn($key, is_array($value) ? $value : [$value]);
            }
        }
    }
}
