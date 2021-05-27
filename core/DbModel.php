<?php

namespace app\core;
use \PDO;

// Every model must have these
/**
 * findOne(condition)
 * findAll(condition)
 * updateOne()
 * updateAll()
 */
abstract class DbModel extends Model
{
    abstract public  static function tableName(): string;

    abstract public static function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName(".implode(',', $attributes).") 
                VALUES(".implode(',', $params).")");
        
        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});            
        }
       
        $statement->execute();
        return true;
    }

    public static function findOne($where) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement = self::prepare("SELECT * from $tableName WHERE $sql LIMIT 1");
        foreach($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        // Kthe objekt sipas tipit te klases
        return $statement->fetchObject(static::class);
    }

    public static function find($where) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement = self::prepare("SELECT * from $tableName WHERE $sql");
        foreach($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();

        // Kthe objekt sipas tipit te klases
        $statement->setFetchMode( PDO::FETCH_CLASS , static::class );
        $rows = $statement->fetchAll();
        return $rows;
    }

    public static function deleteOne($where) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $toBeDeleted = $this->findOne($where);
        $statement = self::prepare("DELETE from $tableName WHERE $sql LIMIT 1");
        foreach($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();

        // Kthe objekt sipas tipit te klases
        return $toBeDeleted;
    }

    public static function delete($where) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement = self::prepare("DELETE from $tableName WHERE $sql");
        foreach($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();

        // Kthe objekt sipas tipit te klases
        return true;
    }

    public static function updateOne($where, $updates) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $updateAttributes = array_keys($updates);
        $sql1 = implode(", ",array_map(fn($attr) => "$attr = :$attr", $updateAttributes));
        $sql2 = implode(" AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement = self::prepare("UPDATE $tableName SET $sql1 WHERE $sql2 LIMIT 1");

        foreach($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        foreach($updates as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        
        $statement->execute();

        // Kthe objekt sipas tipit te klases
        return true;

    }

    public static function update($where, $updates) {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $updateAttributes = array_keys($where);
        $sql1 = implode(", ",array_map(fn($attr) => "$attr = :$attr-1", $attributes));
        $sql2 = implode(" AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
        // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
        $statement = self::prepare("UPDATE $tableName SET $sql1 WHERE $sql2");
        foreach($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        foreach($updates as $key => $item) {
            $statement->bindValue(":$key-1", $item);
        }
        
        $statement->execute();

        // Kthe objekt sipas tipit te klases
        return true;
    }


    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}