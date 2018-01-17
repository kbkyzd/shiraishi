<?php

namespace tsumugi\Repositories;

class TransactionRepository
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
    public function __construct(TransactionRepository $transaction)
    {
        $this->transaction = $transaction;
    }

    public function createOrder()
    {
    }
}
