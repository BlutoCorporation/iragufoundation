<?php

class Session
{
    public static $user = null;

    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            ini_set("session.gc_maxlifetime", 60 * 60 * 24 * 30);
            session_set_cookie_params(60 * 60 * 24 * 30);
            session_start();
        }
    }

    public static function destroy()
    {
        if (session_status() !== PHP_SESSION_NONE)
        {
            session_unset();
            session_destroy();
            return true;
        }
        return false;
    }

    public static function regenerate()
    {
        session_regenerate_id(true);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function isset($key)
    {
        return isset($_SESSION[$key]);        
    }

    public static function getUser()
    {
        return Session::get("Loggedin", "Guest");
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION["Loggedin"]);
    }
}

?>