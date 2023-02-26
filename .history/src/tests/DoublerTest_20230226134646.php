<?php

use PHPUnit\Framework\TestCase;


class DoublerTest extends TestCase
{
    public function testDouble(): void
    {
        require_once(__DIR__ . '/../oubler.php');
        $this->assertEquals(4, double(2));
        $this->assertEquals(10, double(5));
        $this->assertEquals(-6, double(-3));
    }
}




