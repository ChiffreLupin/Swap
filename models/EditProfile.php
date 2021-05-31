<?php
/**
    Class User
    @package app\models
*/

namespace app\models;
use app\core\UserModel;

//RegisterModel name changed to User
class EditProfile extends UserModel {
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public int $id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public int $blocked = 0;
    public string $state = '';
    public string $city = '';
    public string $street = '';
    public string $zip= '';
    public string $type = 'client';
    public string $description = '';

    public static function tableName(): string
    {
        return 'user';
    }

    public function save() {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();        
    }

    public function rules(): array {
        return  [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],                                    
            'state' => [self::RULE_REQUIRED],
            'street' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED],
            'zip' => [self::RULE_REQUIRED]
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
        return ['firstname', 'lastname', 'profile_picture', 'blocked', 'state', 'city', 'street', 'zip','type', 'description'];
    }

    public function displayName(): string {
        return $this->firstname.' '.$this->lastname;
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',            
            'blocked' => 'Blocked',            
            'state' => 'State',
            'city' => 'City',
            'street' => 'Street',
            'zip' => 'Zip',
            'description' => 'Description'
        ];
    }

    public function stateValue($state) {
      
        $valueStates = [
            "Albania" => 1,
            "England" => 2,
            "Danmark" => 3,
            "Germany" => 4,
            "Greece" => 5,
            "France" => 6,
            "Kosovo" => 7,
            "Norway" => 8,
            "New Zeland"  => 9,
            "Montenegro" => 10
        ];

        return $valueStates[$state];
    }
}