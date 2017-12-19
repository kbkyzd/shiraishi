<?php

namespace shiraishi\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform($product)
    {
        return [
            'merchant' => [
                'name' => $product->user->name,
                'id'   => $product->user->id,
            ],
            'product'  => [
                'name'        => $product->name,
                'description' => $product->description,
                'price'       => $product->price,
            ],
        ];
    }
}
