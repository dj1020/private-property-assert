<?php

use App\ToTestSetter;

class ToTestSetterTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_should_be_true() {
        $this->assertTrue(true);
    }

    /** @test */
    function it_should_instantiate_ToTestSetter_class() {
        $target = new ToTestSetter();

        $this->assertInstanceOf(ToTestSetter::class, $target);
    }

    /** @test */
    function it_should_be_able_to_assert_a_private_property_in_object() {
        $target = new ToTestSetter();

        $target->setName('Ken');

        $this->assertObjectHasAttribute('name', $target);
        $this->assertAttributeEquals('Ken', 'name', $target);
    }
}