<?php

require_once('vendor/autoload.php');

class SampleTest extends PHPUnit\Framework\TestCase {
  public function test_add() {
      $sample = new App\Sample();
      $this->assertEquals(10, $sample->Add(4, 6));
  }

  public function test_sub() {
      $sample = new App\Sample();
      $this->assertEquals(1, $sample->Sub(7, 6));
  }
}


?>