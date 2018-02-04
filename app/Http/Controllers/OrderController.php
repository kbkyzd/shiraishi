<?php

namespace shiraishi\Http\Controllers;

use shiraishi\Order;
use Illuminate\Http\Request;
use tsumugi\Foundation\QrCode;
use tsumugi\Repositories\OrderRepository;

class OrderController extends Controller
{
    /**
     * @var \tsumugi\Repositories\OrderRepository
     */
    protected $orders;

    /**
     * @var \tsumugi\Foundation\QrCode
     */
    protected $qrCode;

    public function __construct(OrderRepository $orders, QrCode $qrCode)
    {
        $this->orders = $orders;
        $this->qrCode = $qrCode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()->processedOrders;

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function pay(Order $order)
    {
        $order = $this->orders->pay($order, auth()->user());
    }

    /**
     * @param $orderId
     * @return mixed
     */
    protected function qrForPay($orderId)
    {
        $qrCode = $this->qrCode->generate(
            route('front.pay', [
                'order' => $orderId,
            ])
        );

        return response($qrCode, 200)
            ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = $this->orders->create($request->orders, auth()->user());

        return $this->qrForPay($order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \shiraishi\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \shiraishi\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
