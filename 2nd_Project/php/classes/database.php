<?php

class DB {
    protected $instance;

    public function __construct() {
        try {
            // Adjust your database credentials here
            $dsn = 'mysql:host=localhost;dbname=public_library';
            $username = 'root';
            $password = '';

            $this->instance = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function getInstance() {
        return $this->instance;
    }
}
?>
