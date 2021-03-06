<?php

namespace tsumugi\Repositories;

use shiraishi\User;
use shiraishi\Order;
use shiraishi\Product;
use shiraishi\Events\TransactionProcessed;

class OrderRepository
{
    /**
     * @var \tsumugi\Repositories\TransactionRepository
     */
    protected $transaction;

    public function __construct(TransactionRepository $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param $orderId
     * @return \Illuminate\Database\Eloquent\Collection|\shiraishi\Order
     */
    public function find($orderId)
    {
        return Order::findOrFail($orderId);
    }

    /**
     * @param \shiraishi\User|\Illuminate\Contracts\Auth\Authenticatable $user
     * @param int                                                        $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function recent(User $user, $perPage = 30)
    {
        return $user->orders()
                    ->whereNotNull('processed_at')
                    ->paginate($perPage);
    }

    /**
     * @param \shiraishi\Order                                           $order
     * @param \shiraishi\User|\Illuminate\Contracts\Auth\Authenticatable $user
     * @return mixed
     */
    public function pay(Order $order, User $user)
    {
        return tap($order, function (Order $order) use ($user) {
            $order->user()->associate($user);
            $order->processed_at = now();
            $this->transaction->updateStock($order);

            $order->saveOrFail();
            event(new TransactionProcessed($order));
        });
    }

    /**
     * @param                                                            $transactions
     * @param \shiraishi\User|\Illuminate\Contracts\Auth\Authenticatable $user
     * @return \shiraishi\Order
     */
    public function create($transactions, User $user)
    {
        $hydrated = $this->hydrateProducts($transactions);

        /** @var Order $newOrder */
        $newOrder = $user->orders()->create();

        $orders = $newOrder->transactions()
                           ->createMany($hydrated);

        return $newOrder;
    }

    /**
     * @param $transactions
     * @return array
     */
    protected function hydrateProducts($transactions): array
    {
        return array_map(function ($transaction) {
            $product = Product::find($transaction['product_id']);
            $transaction['order_snapshot'] = $product->toJson();

            return $transaction;
        }, $transactions);
    }
}
