<?php

namespace tsumugi\Repositories;

use shiraishi\Order;
use tsumugi\Exceptions\InsufficientStockException;

class TransactionRepository
{
    /**
     * @param \shiraishi\Order $order
     * @throws \Throwable
     * @throws \tsumugi\Exceptions\InsufficientStockException
     */
    public function updateStock(Order $order)
    {
        /** @var \shiraishi\Transaction $transaction */
        foreach ($order->transactions as $transaction) {
            $product = $transaction->product;
            $currentStock = $product->stock;
            $updatedStock = $currentStock - $transaction->quantity;

            if ($updatedStock < 0) {
                throw new InsufficientStockException("Insufficient stock for {$product->name}");
            }

            $product->stock = $updatedStock;

            $product->saveOrFail();
        }
    }
}
