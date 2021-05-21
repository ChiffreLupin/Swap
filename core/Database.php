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

     public function applyMigrations()
     {
        // Create migrations table before applying to make sure 
        // the table exists
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();                        
        $newMigrations = [];
        // Returns all files inside directory - get all migrations that
        // have been added since last migration application
        $files = scandir(Application::$ROOT_DIR.'/migrations');  
        // Substrct from all migrations inside files variables
        // migrations stored in database that have been already applied
        $toApplyMigrations = array_diff($files, $appliedMigrations);        
        
        foreach($toApplyMigrations as $migration)
        {
            if($migration === '.' || $migration === '..')
            {
                continue;
            }

            // Include declaration of migration class which we will apply
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);  
            // Create instance of migration                                  
            $instance = new $className();
            $this->log("Applying migration $migration");
            // Apply migration on database
            $instance->up();
            $this->log("Applied migration $migration");
            // Store applied migration in array so we can use it later
            $newMigrations[] = $migration;
        }

        if(!empty($newMigrations))
        {
            $this->saveMigrations($newMigrations);            
        }
        else
        {
            $this->log("All migrations applied");
        }
     }
    
     public function createMigrationsTable()
     {
        // Table with applied migrations
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE = INNODB;");
     }      

     public function getAppliedMigrations()
     {
        // Get all migration names from migration table
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        //fetch all the migration column values as a single dimensional array
        // otherwise the result would be an array where each row is a subarray
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
     }     

     // Since we need to prepare SQL statements we make it a method
     public function prepare($sql)
     {
         return $this->pdo->prepare($sql);
     }

     public function saveMigrations(array $migrations)
     {
        $str = implode(",",array_map(fn($m) => "('$m')", $migrations));        
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statement->execute();
     }

     protected function log($message)
     {
         echo '['.date('Y-m-d H:i:s').'] - ' . $message . PHP_EOL;
     }
}