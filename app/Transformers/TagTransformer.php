<?php

namespace shiraishi\Transformers;

use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform($tag)
    {
        return [
            'name' => $tag->name,
            'slug' => $tag->slug,
        ];
    }
}
