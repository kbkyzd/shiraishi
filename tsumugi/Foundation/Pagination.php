<?php

namespace tsumugi\Foundation;

trait Pagination
{
    /**
     * @var int
     */
    protected $perPage;

    /**
     * Determine how many pages should the API return.
     *
     * @param int $items
     * @param int $min
     * @param int $max
     * @return int
     */
    protected function limit($items, $min = 5, $max = 30)
    {
        $items = (int) $items;
        if (! is_numeric($items)) {
            return $min;
        }

        if ($items >= $max) {
            return $max;
        }
        if ($items <= $min) {
            return $min;
        }

        return $items;
    }
}
