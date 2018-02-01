<?php

namespace shiraishi\Transformers;

use shiraishi\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'transactions',
    ];

    public function transform(Order $order)
    {
        return [
            'id'           => $order->id,
            'processed_at' => $order->processed_at ? (string) $order->processed_at : null,
            'created_at'   => (string) $order->created_at,
            'updated_at'   => (string) $order->updated_at,
        ];
    }

    /**
     * @param \shiraishi\Order $order
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTransactions(Order $order)
    {
        $transactions = $order->transactions;

        return $this->collection($transactions, new TransactionTransformer());
    }
}
