<?php

namespace Hkp22\LaravelTaggable\Traits;

trait TaggableScopes
{
    /**
     * A scope to retrieve any model that has ANY OF the given tags.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  array|string                         $tags
     * @return Illuminate\Database\Eloquent\Builder
     */
     public function scopeWithAnyTag($query, $tags)
    {
        return $query->hasTags($tags);
    }

    /**
     * A scope to retrieve any model that has ALL the given tags.
     *
     * @param  Illuminate\Database\Eloquent\Builder $query
     * @param  array                                $tags
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllTags($query, array $tags)
    {
        foreach ($tags as $tag) {
            $query->hasTags($tag);
        }

        return $query;
    }

    /**
    * A scope to retrieve any model that has the given tags.
    *
    * @param  Illuminate\Database\Eloquent\Builder $query
    * @param  array|string                         $tags
    * @return Illuminate\Database\Eloquent\Builder
    */
    public function scopeHasTags($query, $tags)
    {
        $tags = array_flatten([$tags]);

        return $query->whereHas('tags', function ($query) use ($tags) {
            return $query->whereIn('slug', $tags);
        });
    }
}
