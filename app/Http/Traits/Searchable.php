<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    public function scopeSearch(Builder $builder, string $search = null)
    {
        if ($search) {
            if (!$this->search_fields) {
                throw new \Exception("Please define the search_fields property .");
            }

            if (count($this->search_fields) > 0) {
                $builder = $builder->where(function ($query) use ($search) {
                    foreach ($this->search_fields as $field) {
                        if (str_contains($field, '.')) {
                            $relation = Str::beforeLast($field, '.');
                            $column = Str::afterLast($field, '.');

                            if (count($this->search_fields) > 1) {
                                $query->orWhereRelation($relation, $column, 'like', '%' . $search . '%');
                            } else {
                                $query->WhereRelation($relation, $column, 'like', '%' . $search . '%');
                            }
                            continue;
                        }

                        if (count($this->search_fields) > 1) {
                            $query->orWhere($field, 'like', '%' . $search . '%');
                        } else {
                            $query->Where($field, 'like', '%' . $search . '%');
                        }
                    }
                });
            }
        }

        return $builder;
    }

    public function scopeFilter(Builder $builder, $request = null)
    {
        if (!$this->filter_fields) {
            throw new \Exception("Please define the filter_fields property .");
        }

        if (count($request->all())) {
            foreach ($this->filter_fields as $field) {
                if ($request->$field) {
                    if (str_contains($field, '.')) {
                        $relation = Str::beforeLast($field, '.');
                        $column = Str::afterLast($field, '.');

                        $builder->orWhereHas($relation, function ($query) use ($column, $request) {
                            return $query->whereIn($column, explode(',', $request->$column));
                        });
                        continue;
                    }

                    $builder->orWhereIn($field, explode(',', $request->$field));
                }
            }
        }

        return $builder;
    }
}
