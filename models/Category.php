<?php
namespace app\models;
use app\core\Model;
use app\core\DbModel;
use app\core\Product;
use \PDO;

class Category extends DbModel
{   
    public int $category_id;
    public string $category_name;
    public string $description;  
    public string $image;
    public ?array $products = null;

    public function rules(): array
    {

    }
    
    public static function tableName(): string
    {
        return 'category';
    }

    public static function attributes(): array
    {
        return ['category_id, category_name, description, image'];
    }

    public static function primaryKey(): string
    {
        return 'category_id';
    }

    //kthen array me kategorite
    public static function findCategories() {
        $tableName = static::tableName();                
        // SELECT * FROM $tableName 
        $statement = self::prepare("SELECT * from $tableName");        
        $statement->execute();        
        // Kthe objekt sipas tipit te klases
        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }


    //kthen array me kategorite
    public static function getCategories()
    {
        $categories = static::findCategories();
        if(!$categories)
        {
            return false;
        }        
        return $categories;
    }

}