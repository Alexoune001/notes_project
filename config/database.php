<?php

class Database 
{
    private static $instance = null;
    private $connection;

    private function __construct() 
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=projet_notes', 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getConnection() 
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
