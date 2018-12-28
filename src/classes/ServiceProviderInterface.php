<?php

interface ServiceProviderInterface {
    function boot();
    function register();
    function getClass();
    function getInstance();
    function run();
}