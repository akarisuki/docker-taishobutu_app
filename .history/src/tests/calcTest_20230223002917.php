<?php
require_once '/Users/ishizakifumiten/Documents/code/docker-taishobutu-app/src/taishobutu_app/calc.php';
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