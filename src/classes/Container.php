<?php

namespace Component\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var \Closure[]
     */
    private $definitions = [];
    
    private $shared = [];
    

    public function get($id)
    {
        if (!$this->has($id)) {
            throw NotFoundException::create($id);
        }

        return $this->definitions[$id];
    }

    public function has($id)
    {
       
        return isset($this->definitions[$id]);
    }

    /**
     * Adds an entry to the container.
     *
     * @param string   $id       Identifier of the entry.
     * @param \Closure $value    The closure to invoke when this entry is resolved.
     *                           The closure will be given this container as the only
     *                           argument when invoked.
     */
    public function set($id,  $value, $shared = false)
    {
        if(is_callable($value)) {
            $this->definitions[$id] = [$value, $shared];
            return $this->definitions[$id];
        }
        throw new ContainerException("Invalid callback value for {$id}. Value needs to be callable.");
        
    }
    
    public function share($id, $value) {
       return $this->set($id, $value, true);
    }
    
    public function make($id) {
        $definition = $this->get($id);
        $callable = $definition[0];
        $isShared = $definition[1];
        
        if($isShared) {
            $obj = $this->shared[$id];
            if(is_null($obj)) {
                $obj = $this->shared[$id] = $callable($this);
            }
            return $obj;
        }
        return $callable($this);
        
    }
    
    public function getAll() {
        return $this->definitions;
    }
    
}
