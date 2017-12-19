<?php

namespace tsumugi\Foundation;

trait Pagination
{
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
        if (! is_numeric($items)) {
            return $min;
        }

        switch ($items) {
            case $items > $max:
                return $max;
            case $items < $min:
                return $min;
            default:
                return $items;
        }
    }
}
