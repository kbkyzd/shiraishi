<?php

namespace Tests\Unit;

use Tests\TestCase;
use tsumugi\Foundation\Pagination;

class PaginationTest extends TestCase
{
    use Pagination;

    public function testPaginationLimit()
    {
        $discardsInvalidInput = $this->limit(str_random(1));
        $this->assertSame(5, $discardsInvalidInput);

        $returnsMinimum = $this->limit(random_int(0, 4));
        $this->assertSame(5, $returnsMinimum);

        $returnsMaximum = $this->limit(random_int(31, 40));
        $this->assertSame(30, $returnsMaximum);

        $min = $this->limit(5);
        $this->assertSame(5, $min);

        $max = $this->limit(30);
        $this->assertSame(30, $max);

        $input = random_int(6, 29);
        $validNumber = $this->limit($input);
        $this->assertSame($input, $validNumber);
    }
}
