<?php

class ServiceProvider implements ServiceProviderInterface {
    
    const SIGNATURE = 
    
    public $shared = false;
    
    public $factory;
    
    protected $resolvedArgs;
    
    private $instance;
    
    protected static $loaded = null;
    
    private $container;
    
    public function __construct(Container $container, \Closure $factory, $shared = false) {
        if(empty($factory) || !is_callable($factory)) {
            $class = get_class($this);
            $msg = "{$class} provided an invalid factory callback. Factory callback must be callable.";
            throw new ServiceProviderException($msg);
        }
        $this->factory = $factory;
        $this->setContainer($container);
        
        if($shared) {
            $this->shared = true;
        }
        else {
            //Services with unique identifier
            $this->loaded = array();
        }
        
        
    }
    
    public function register() {
        $this->getContainer()->set($this);
    }
    
    public function load() {
        
        if($this->isShared()) {
            static $obj;
            if(is_null($obj)) {
                $obj = $this->create($this->getFactory(), $this->getResolvedArgs());
            }
            return $obj;
        }
        return $this->create($this->getFactory(), $this->getResolvedArgs());
    })
    
   
    
}