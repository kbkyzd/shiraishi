<?php

namespace tsumugi\Repositories;

use shiraishi\Product;
use Illuminate\Support\Collection;
use NlpTools\Similarity\CosineSimilarity;

class TagsRepository
{
    /**
     * @var \NlpTools\Similarity\CosineSimilarity
     */
    protected $cosineSimilarity;

    /**
     * TagsRepository constructor.
     *
     * @param \NlpTools\Similarity\CosineSimilarity $cosineSimilarity
     */
    public function __construct(CosineSimilarity $cosineSimilarity)
    {
        $this->cosineSimilarity = $cosineSimilarity;
    }

    /**
     * Finds similar products based on tags.
     *
     * @param \shiraishi\Product $product
     * @return array
     */
    public function similar(Product $product)
    {
        $originalTags = $product->prettyTags();

        $products = Product::withTag($originalTags)
                           ->get();

        return $this->calculateSimilarity($originalTags, $products);
    }

    /**
     * Calculate the cosine similarity between an item and a collection.
     *
     * @param array                          $originalTags
     * @param \Illuminate\Support\Collection $products
     * @return array
     */
    protected function calculateSimilarity(array $originalTags, Collection $products)
    {
        $indexed = $products->map(function (Product $product) use ($originalTags) {
            $newProduct = $product->toArray();
            $productTags = $product->prettyTags();

            $newProduct['cos'] = $this->cosineSimilarity->similarity($originalTags, $productTags);
            $newProduct['tags'] = $productTags;

            return $newProduct;
        });

        $sorted = $indexed->sortByDesc('cos')
                          ->values();

        $sorted->shift();

        return $sorted->all();
    }
}
