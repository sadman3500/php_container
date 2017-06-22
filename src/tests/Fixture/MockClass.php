<?php

namespace Test\Fixture;

class MockClass {
    public $dependency;
    public $id;
    public function __construct(MockDependencyClass $dependency) {
        $this->dependency = $dependency;
        $this->id = uniqid();
    }
   
}