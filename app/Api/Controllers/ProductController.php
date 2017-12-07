<?php

namespace shiraishi\Api\Controllers;

use shiraishi\Product;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use shiraishi\Http\Controllers\Controller;

class ProductController extends Controller
{
    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::paginate(10);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $product = $user->products()->create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return $this->accepted($product);
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $this->response->array($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \shiraishi\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \shiraishi\Product       $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return $this->accepted($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \shiraishi\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * @param \shiraishi\Product $product
     * @return \Dingo\Api\Http\Response
     */
    protected function accepted(Product $product)
    {
        return $this->response->accepted(
            route('products.show', [
                'product' => $product->id,
            ]),
            $product
        );
    }
}
