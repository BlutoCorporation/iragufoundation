<?php

class WebAPI
{
    public function __construct()
    {
        global $__site_config;
        $__site_config_path = __DIR__.'/../config.json';
        $__site_config = file_get_contents($__site_config_path);
        Database::getConnection();
    }
}