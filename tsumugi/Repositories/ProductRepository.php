<?php

namespace tsumugi\Repositories;

use shiraishi\Order;
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

    public function search($term, $perPage = 30)
    {
        return Product::where('name', 'LIKE', "%$term%")
                      ->orWhere('description', 'LIKE', "%$term%")
                      ->paginate($perPage);
    }
}
