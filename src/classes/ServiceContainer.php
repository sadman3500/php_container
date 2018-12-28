<?php

class ServiceContainer extends Container {
    public $serviceProviders = array();
    
    public function make($id)
    {
        $services = & $this->servicesProviders;
        if(!is_null($services[$id])) {
            return $services[$id];
        }
        
        $services[$id] = parent::make($id);

        return $services[$id];
    }
    
    protected function getServices() {
        return $this->services;
    }
    
}