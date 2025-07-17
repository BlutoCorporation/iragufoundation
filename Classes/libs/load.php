<?php

require_once "Database.class.php";
require_once "Session.class.php";
require_once "User.class.php";
require_once "WebAPI.class.php";
require_once "Operations.class.php";
require_once __DIR__ . '/vendor/autoload.php';

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// $wapi = new WebAPI();
global $__site_config;
$__site_config_path = __DIR__.'/../config.json';
$__site_config = file_get_contents($__site_config_path);
Database::getConnection();

function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

?>