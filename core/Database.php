<?php
// core/Database.php
namespace core;

use PDO;
use PDOException;

class Database {
    private $host;
    private $port;
    private $dbname;
    private $user;
    private $password;
    private $connection;

    public function __construct($config) {
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->dbname = $config['dbname'];
        $this->user = $config['user'];
        $this->password = $config['password'];
    }

    public function connect() {
        if ($this->connection === null) {
            try {
                // Incluye el puerto en el DSN
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
                $this->connection = new PDO($dsn, $this->user, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return $this->connection;
    }
    
}
