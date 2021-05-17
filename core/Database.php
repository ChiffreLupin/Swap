<?php

/**
    Class Database
    @package app\controllers
 */

namespace app\core;

class Database {
    
    /**
     * Database constructor
     */
    public \PDO $pdo;

     public function __construct(array $config) {
         $dsn = $config['dsn'] ?? '';
         $user = $config['user'] ?? '';
         $password = $config['password'] ?? '';
         // dsn is domain service name defines port,host, database
        $this->pdo = new \PDO($dsn, $user, $password);
        // On some problem regarding the database interface (this pdo) throws exception
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
     }
}