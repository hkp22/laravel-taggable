<?php

namespace Hkp22\LaravelTaggable\Traits;

use Illuminate\Support\Collection;
use Hkp22\LaravelTaggable\Models\Tag;

trait Taggable
{
    /**
     * The tags relationship to this model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Tag this model.
     *
     * @param  mixed $tags
     * @return void
     */
    public function tag($tags)
    {
        $this->addTags($this->getWorkableTags($tags));
    }

    /**
    * Adds specified tags.
    *
    * @param  Illuminate\Support\Collection $tags
    * @return void
    */
    private function addTags(Collection $tags)
    {
        $sync = $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());
    }

    /**
    * Given either an array of Tag slugs, a single Tag model
    * or a Collection of Tags, return only a Collection of
    * Tags so they can be easily worked with in here.
    *
    * @param  mixed $tags
    * @return Illuminate\Database\Eloquent\Collection
    */
    private function getWorkableTags($tags)
    {
        $tags = is_string($tags) ? [$tags] : $tags;

        if (is_array($tags)) {
            return $this->getTagModels($tags);
        }

        if ($tags instanceof Model) {
            return $this->getTagModels([$tags->slug]);
        }

        // Assume a collection
        return $this->filterTagsCollection($tags);
    }

    /**
     * Get a collection of Tag models by slug.
     *
     * @param  array                                   $tags
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function getTagModels(array $tags)
    {
        return Tag::whereIn('slug', $this->normaliseTagNames($tags))->get();
    }

    /**
     * Normalise tag names provided when querying (perhaps to tag or
     * untag a model), such that they can always be used to lookup
     * tags from the database by their slug.
     *
     * @param  array $tags
     * @return array
     */
    private function normaliseTagNames(array $tags)
    {
        return array_map(function ($tag) {
            return str_slug($tag);
        }, $tags);
    }

    /**
     * Filter Tags in a Collection to make sure they are actually
     * an instance of a model. We're not checking for a Tag
     * model here, because another model name may be used.
     *
     * @param  Illuminate\Support\Collection $tags
     * @return Illuminate\Support\Collection
     */
    private function filterTagsCollection(Collection $tags)
    {
        return $tags->filter(function ($tag) {
            return $tag instanceof Model;
        });
    }
}
