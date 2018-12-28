<?php

interface ServiceProviderInterface {
    
    public function register();
    
    public function provides($service = null);
    
    public function load();
    
    public function boot();
    
    public function getFactory();
    
    public function setFactory(\Closure $factory);
    
    public function create(\Closure $factory, $args = null);
    
    public function resolveArguments(array $args);
    
    public function isLoaded();
    
    public function getService();
    
    public function setService();
    
    public function isShared($shared = false);
    
    public function getArgs();
    
    public function getResolvedArgs();
    
    public function getContainer();
    
    public function setContainer(Container $container);
}