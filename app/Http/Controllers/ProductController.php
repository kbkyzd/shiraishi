<?php

namespace shiraishi\Http\Controllers;

use shiraishi\Product;
use Illuminate\Http\Request;
use tsumugi\Repositories\ProductRepository;
use tsumugi\Repositories\RecommenderRepository;

class ProductController extends Controller
{
    /**
     * @var \tsumugi\Repositories\ProductRepository
     */
    protected $product;

    /**
     * @var \tsumugi\Repositories\RecommenderRepository
     */
    protected $tags;

    public function __construct(ProductRepository $product, RecommenderRepository $tags)
    {
        $this->product = $product;
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->fetchProducts($request);

        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Product $store
     * @return \Illuminate\Http\Response
     */
    public function show(Product $store)
    {
        $similarProducts = $this->tags->similarCached($store);
        $hydrated = collect($similarProducts)->map(function ($product) {
            return Product::find($product['id']);
        });

        return view('products.show', [
            'product' => $store,
            'similar' => $hydrated,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \shiraishi\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \shiraishi\Product       $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \shiraishi\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    protected function fetchProducts(Request $request)
    {
        if ($request->tags) {
            return $this->product->searchWithTags($request->s, $request->tags, 12);
        }

        if ($request->s) {
            return $this->product->search($request->s, 12);
        }

        return $this->product->paginate(15);
    }
}
