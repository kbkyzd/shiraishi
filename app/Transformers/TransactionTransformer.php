<?php

namespace shiraishi\Transformers;

use shiraishi\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'product',
    ];

    public function transform(Transaction $transaction)
    {
        return [
            'id'       => $transaction->id,
            'quantity' => $transaction->quantity,
        ];
    }

    public function includeProduct(Transaction $transaction)
    {
        return $this->item($transaction->product, new ProductTransformer());
    }
}
