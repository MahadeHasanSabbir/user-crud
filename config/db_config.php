<?php

class DBConfig
{
    private $host = "localhost";
    private $dbname = "user_crud";
    private $username = "root";
    private $password = "";
    public $connect;

    public function getConnection()
    {
        $this->connect = null;

        try {
            $this->connect = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Log the error internally
            error_log("Database connection failed: " . $e->getMessage());
            // Show a generic message to the user
            die("We are experiencing technical difficulties. Please try again later.");
        }

        return $this->connect;
    }
}

?>
