<?php
/**
    Class Product
    @package app\models
*/

namespace app\models;
use app\models\User;
use app\core\DbModel;

//RegisterModel name changed to User
class Product extends DbModel {
 

    public int $id = 0;
    public string $name = '';
    public int $amount = 0;
    public string $imagePath = '';
    public string $description = '';
    public $created_at = "";
    public int $category_id = -1;
    public int $user_id = -1;
    public ?User $user = null;

    public function __construct() {
        $created_at = date("Y.m.d");
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
            "amount" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 0]],
            "imagePath" => [self::RULE_REQUIRED],
            "description" => [self::RULE_REQUIRED]
        ];
    }

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
           "name" => "Name",
           "amount" => "Amount",
           "imagePath" => "Upload Image",
           "description" => "Description"
        ];
    }
}