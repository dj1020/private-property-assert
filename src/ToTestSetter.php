<?php
namespace App;

class ToTestSetter {

    private $name;

    public function setName($name = '') {
        $this->name = $name;
    }
}