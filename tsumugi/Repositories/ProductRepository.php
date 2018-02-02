<?php

namespace tsumugi\Repositories;

use shiraishi\Product;

class ProductRepository implements RepositoryInterface
{
    public function all()
    {
    }

    public function first()
    {
    }

    public function paginate()
    {
    }

    public function find($id)
    {
    }

    public function allTags()
    {
        return Product::allTags()
                      ->get();
    }

    public function search($term, $perPage = 30)
    {
        return Product::where('name', 'LIKE', "%$term%")
                      ->orWhere('description', 'LIKE', "%$term%")
                      ->paginate($perPage);
    }

    public function searchWithTags($term, $tags, $perPage = 30)
    {
        if (! $term) {
            return Product::whereTag($tags)
                          ->paginate($perPage);
        }

        return Product::whereTag($tags)
                      ->where('name', 'LIKE', "%$term%")
                      ->orWhere('description', 'LIKE', "%$term%")
                      ->paginate($perPage);
    }
}
