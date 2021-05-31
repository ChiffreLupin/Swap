<?php
/**
    Class Product
    @package app\models
*/

namespace app\models;
use app\models\User;
use app\core\DbModel;
use \PDO;

//RegisterModel name changed to User
class Product extends DbModel {
    public int $id = 0;
    public string $name = '';
    public int $amount = 0;
    public string $imagePath = '';
    public string $description = '';
    public string $created_at = "";
    public int $category_id = -1;
    public int $user_id = -1;
    public ?User $user = null;

    public function __construct() {
        $this->created_at = date("Y.m.d h:i:s");
    }


    public static function tableName(): string
    {
        return 'product';
    }

    public function save() {
        return parent::save();        
    }

    public function rules(): array {
        return  [
            "name" => [self::RULE_REQUIRED],
            "amount" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 1]],
            "imagePath" => [self::RULE_REQUIRED]
        ];
    }

    // public function getProducts($where)
    // {
    //     $tableName = static::tableName();
    //     $attributes = array_keys($where);
    //     $sql = implode("AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
    //     // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
    //     $statement = self::prepare("SELECT * from $tableName WHERE $sql");
    //     foreach($where as $key => $item) {
    //         $statement->bindValue(":$key", $item);
    //     }
    //     $statement->execute();

    //     // Kthe objekt sipas tipit te klases
    //     return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    // }

    // public function getProductsToAdd($where,$lim)
    // {
    //     $tableName = static::tableName();
    //     $attributes = array_keys($where);
    //     $sql = implode("AND ",array_map(fn($attr) => "$attr = :$attr", $attributes));
    //     // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
    //     $statement = self::prepare("SELECT * from $tableName WHERE $sql LIMIT $lim");
    //     foreach($where as $key => $item) {
    //         $statement->bindValue(":$key", $item);
    //     }
    //     $statement->execute();

    //     // Kthe objekt sipas tipit te klases
    //     return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    // }

    public function hasError($attribute) {
        return $this->errors[$attribute] ?? false;
    }

    public static function primaryKey(): string {
        return 'id';
    }

    public static function attributes():array
    {
        return ['name', 'amount', 'imagePath', 'created_at','description'];
    }

    public function labels(): array
    {
        return [
           "name" => "Product Name",
           "amount" => "Amount",
           "imagePath" => "Upload Image",
           "description" => "Description"
        ];
    }

    public static function createProduct($attributeValues)
    {        
        $tableName = static::tableName();
        $values = array_values($attributeValues);
        $values2 = array_keys($attributeValues);        
        $i = 0;
        foreach($values as $key => $valu){
        $array[$i] = $valu;
        $i++;
        }        
        $statement = self::prepare("INSERT INTO `product`(`name`, `amount`, `imagePath`, `description`, `category_id`, `user_id`)
                     VALUES('$array[0]', '$array[1]','', '$array[3]', '$array[2]', '$array[4]')");
        $statement->execute();
        $statement = self::prepare("SELECT `id` FROM `product` WHERE `user_id` = '$array[4]' AND `description` = '$array[3]'");
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }
}