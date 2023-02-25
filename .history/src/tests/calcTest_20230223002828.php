<?php

use PHPUnit\Framework\TestCase;



class calcTest extends TestCase{

  protected $object;
  protected function setUp() :void {
      $this->object = new Calc();
  }

  public function testAdd() {
      $this->assertEquals(5,$this->object->add(2,3));
  }
  
}




?>