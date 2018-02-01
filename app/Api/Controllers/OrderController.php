<?php

namespace shiraishi\Api\Controllers;

use shiraishi\Order;
use Illuminate\Http\Request;
use tsumugi\Repositories\OrderRepository;
use shiraishi\Transformers\OrderTransformer;
use shiraishi\Api\Controllers\BaseApiController as ApiController;

class OrderController extends ApiController
{
    /**
     * @var \tsumugi\Repositories\OrderRepository
     */
    protected $orders;

    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orders->recent($this->user);

        return $this->response->paginator($orders, new OrderTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->orders);
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $this->response->item($order, new OrderTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \shiraishi\Order         $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }
}
