<?php

namespace shiraishi\Api\Controllers;

use shiraishi\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use tsumugi\Foundation\QrCode;
use tsumugi\Repositories\OrderRepository;
use shiraishi\Transformers\OrderTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use shiraishi\Api\Controllers\BaseApiController as ApiController;

class OrderController extends ApiController
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
     * @return \Dingo\Api\Http\Response
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
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders.*.product_id' => 'required|distinct|exists:products,id',
            'orders.*.quantity'   => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create a new order request', $validator->errors());
        }

        $order = $this->orders->create($request->orders, $this->user);

        return $this->qrForPay($order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \shiraishi\Order $order
     * @return \Dingo\Api\Http\Response
     */
    public function show(Order $order)
    {
        return $this->response->item($order, new OrderTransformer());
    }

    /**
     * @param \shiraishi\Order $order
     * @return \Dingo\Api\Http\Response
     */
    public function pay(Order $order)
    {
        $order = $this->orders->pay($order, $this->user);

        return $this->response->item($order, new OrderTransformer());
    }

    /**
     * @param $orderId
     * @return mixed
     */
    protected function qrForPay($orderId)
    {
        $qrCode = $this->qrCode->generate(
            api_route('order.pay', [
                'order' => $orderId,
            ])
        );

        return response($qrCode, 200)
            ->header('Content-Type', 'image/svg+xml');
    }
}
