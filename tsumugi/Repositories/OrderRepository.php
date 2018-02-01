<?php

namespace tsumugi\Repositories;

use shiraishi\User;
use shiraishi\Order;

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

    public function create($transactions)
    {
    }
}
