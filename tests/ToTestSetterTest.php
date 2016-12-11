<?php

use App\ToTestSetter;

class ToTestSetterTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_should_be_true() {
        $this->assertTrue(true);
    }

    /** @test */
    function it_should_instaniate_ToTestSetter_class() {
        $target = new ToTestSetter();

        $this->assertInstanceOf(ToTestSetter::class, $target);
    }
}