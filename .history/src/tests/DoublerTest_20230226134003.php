<?php

use PHPUnit\Framework\TestCase;


class DoublerTest extends TestCase
{
    public function testDouble(): void
    {
        $doubler = new Doubler();
        $this->assertEquals(4, $doubler->double(2));
        $this->assertEquals(10, $doubler->double(5));
        $this->assertEquals(-6, $doubler->double(-3));
    }
}




