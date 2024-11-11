<?php

/**
 * 
 */

function connect()
{
    try {
        $connection = new PDO("mysql:host=localhost;dbname=db_user_system", "imran", "12345");
        return $connection;
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
