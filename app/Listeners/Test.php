<?php

namespace shiraishi\Listeners;

use shiraishi\Events\TransactionProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Test
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionProcessed  $event
     * @return void
     */
    public function handle(TransactionProcessed $event)
    {
        //
    }
}
