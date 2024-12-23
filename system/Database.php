<?php  
    class Database {
        private $dbh;

        public function __construct() {
            $env = parse_ini_file('../config/.env');
            $dsn = "mysql:host=" . $env['DB_HOST'] . ";dbname=" . $env['DB_NAME'];

            try {
                $this->dbh = new PDO($dsn, $env['DB_USER'], $env['DB_PASS']);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        public function query($sql, $params = []) {
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function lastInsertId() {
            return $this->dbh->lastInsertId();
        }
    }