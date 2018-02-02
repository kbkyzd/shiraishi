<?php

namespace shiraishi\Transformers;

use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'tags',
    ];

    /**
     * @param \shiraishi\Product $product
     * @return array
     */
    public function transform($product)
    {
        return [
            'merchant' => [
                'name' => $product->user->name,
                'id'   => $product->user->id,
            ],
            'product'  => [
                'id'          => $product->id,
                'name'        => $product->name,
                'description' => $product->description,
                'price'       => $product->price,
                'image'       => $product->image,
            ],
        ];
    }

    public function includeTags($product)
    {
        return $this->collection($product->tags, new TagTransformer());
    }
}
