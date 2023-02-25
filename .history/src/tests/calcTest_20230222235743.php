<?php

use PHPUnit\Framework\TestCase;
use App\Calc;


class arithmeticTest extends TestCase{

  protected $object;
  protected function setUp() :void {
      $this->object = new Clac();
  }

  public function testAdd() {
      $this->assertEquals(5,$this->object->add(2,3));
  }
  
}




?>