<?php

namespace Test;
use Test\Fixture\MockClass;
use Test\Fixture\MockDependencyClass;
use Component\Container\Container;

class ContainerTest extends BaseTest {
    protected $container;
    protected $callable;
    protected $uncallable;
    protected $definition;
    
    
    protected function setUp()
    {
        $this->container = new Container();
        
        $this->callable = function($c) {
            $dependency = new MockDependencyClass();
            return new MockClass($dependency);
        }; 
        
        $this->definition = [$this->callable, false];
        
    }

 
    public function testSetCallable() {
        $this->assertTrue(is_callable($this->callable));
        $definition = $this->container->set(MockClass::class, $this->callable);
        $this->assertEquals($this->definition, $definition);
        return $this->container;
    }
    
    /**
     * @depends testSetCallable
     */
    
    public function testGetDefinition($container) {
        $this->container = $container;
        $definition = $this->container->get(MockClass::class);
        $this->assertEquals($this->definition, $definition);
        
    }
    
     /**
     * @depends testSetCallable
     */
    
    public function testMakeObj($container) {
        $this->container = $container;
        $obj = $this->container->make(MockClass::class);
        $this->assertInstanceOf(MockClass::class, $obj);
        
    }
    
    /**
     * @depends testSetCallable
     */
 
    public function testMakeObjUnique($container) {
        $this->container = $container;
        $obj1 = $this->container->make(MockClass::class);
        $obj2 = $this->container->make(MockClass::class);
        $this->assertThat(
          $obj1,
          $this->logicalNot(
            $this->equalTo($obj2)
          )
        );
    }
    
    public function testSetShared() {
        $this->assertTrue(is_callable($this->callable));
        $definition = $this->container->share(MockClass::class, $this->callable);
        $this->definition[1] = true;
        $this->assertEquals($this->definition, $definition);
        return $this->container;
    }
    
    /**
     * @depends testSetShared
     */
    
    public function testMakeSharedObj($container) {
        $this->container = $container;
        $obj1 = $this->container->make(MockClass::class);
        $obj2 = $this->container->make(MockClass::class);
        print $obj1->id;
        $this->assertEquals($obj1, $obj2);
    }
    


}
?>