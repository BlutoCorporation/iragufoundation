<?php

class Database
{
    public static $conn = null;

    public static function getConnection()
    {
        if (Database::$conn == null)
        {
            $server = get_config("db_server");
            $username = get_config("db_username");
            $password = get_config("db_password");
            $dbname = get_config("db_name");

            $connection = new mysqli($server, $username, $password, $dbname);

            if ($connection->connect_error)
            {
                die("Connection Failed: " . $connection->connect_error);
            }
            else
            {
                Database::$conn = $connection;
                return Database::$conn;
            }
        }
        return Database::$conn; // Return the connection here.
    }
}

?>