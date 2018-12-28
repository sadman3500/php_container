<?php

namespace Tnm\Container\Definitions;

abstract class AbstractDefinition implements DefinitionInterface {
    
    
    
    public function __construct($id, $value, $shared = false) {
        
    }
    
    public function build(array $args) {
        
    }
}