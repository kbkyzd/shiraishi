<?php

namespace tsumugi\Repositories;

class OrderRepository
{
    /**
     * @var \tsumugi\Repositories\TransactionRepository
     */
    protected $transaction;

    /**
     * OrderRepository constructor.
     *
     * @param \tsumugi\Repositories\TransactionRepository $transaction
     */
    public function __construct(self $transaction)
    {
        $this->transaction = $transaction;
    }

    public function createOrder()
    {
    }
}
