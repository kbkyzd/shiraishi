<?php

namespace shiraishi;

use Cartalyst\Tags\TaggableTrait;
use Cartalyst\Tags\TaggableInterface;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TaggableInterface
{
    use TaggableTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     * Merchant of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return an array representation of the tags.
     *
     * @return array
     */
    public function prettyTags()
    {
        return $this->tags->pluck('slug')
                          ->toArray();
    }
}
