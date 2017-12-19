<?php

namespace shiraishi\Api\Controllers;

use shiraishi\Product;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use tsumugi\Foundation\Pagination;
use shiraishi\Http\Controllers\Controller;
use shiraishi\Transformers\ProductTransformer;

class ProductController extends Controller
{
    use Helpers, Pagination;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = $this->limit($request->limit);

        return $this->response->paginator(
            Product::paginate($itemsPerPage),
            new ProductTransformer()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $product = $user->products()->create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return $this->created($product);
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $this->response->item($product, new ProductTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \shiraishi\Product       $product
     * @return \Dingo\Api\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize($product);

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
        ]);

        return $this->created($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \shiraishi\Product $product
     * @return \Dingo\Api\Http\Response
     *
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Product $product)
    {
        $this->authorize($product);

        $product->delete();

        return $this->response->accepted();
    }

    /**
     * @param \shiraishi\Product $product
     * @return \Dingo\Api\Http\Response
     */
    protected function created(Product $product)
    {
        return $this->response->created(
            route('products.show', [
                'product' => $product->id,
            ]),
            $product
        );
    }
}
