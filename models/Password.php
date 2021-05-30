<?php
/**
    Class Password
    @package app\models
*/

namespace app\models;
use app\core\Model;
use app\core\Application;
class Password extends Model {
    
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $repeatNewPassword = '';


    public function rules(): array 
    {
        return [
            "currentPassword" => [self::RULE_REQUIRED],
            "newPassword" => [self::RULE_REQUIRED],
            "repeatNewPassword" => [self::RULE_REQUIRED,[self::RULE_MATCH, 'match' => 'newPassword']]
        ];
    }

    public function login() {
        
    }

    public function labels(): array {
        return [
            'currentPassword' => 'Current Password',
            'newPassword' => "New Password",
            'repeatNewPassword' => "Confirm New Password"
        ];
    }
}