<?php
/**
    Class RequestNotification
    @package app\models
*/

namespace app\models;
use app\core\DbModel;
//RegisterModel name changed to User
class RequestNotification extends DbModel {
    public const IS_SEEN = 1;
    public const  IS_NOT_SEEN = 0;
   
    public int $id = 0;
    public int $sender_id = -1;
    public int $receiver_id = -1;
    public string $sent_at;
    public string $message = "";
    public int $isSeen = self::IS_NOT_SEEN;
    public int $swap_id = -1;

    public ?Swap $swap = null;
    public ?User $sender = null;
    public ?User $receiver = null;

    public function __construct() {
        $this->sent_at = date("Y.m.d h:i:s");
    }

    public static function tableName(): string
    {
        return 'requestnotifications';
    }

    public function rules(): array {
        return  [
            
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
        return ['sender_id', 'receiver_id','sent_at', 'message', 'isSeen','swap_id'];
    }
}