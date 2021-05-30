<?php
/**
    Class Swap
    @package app\models
*/

namespace app\models;
use app\core\DbModel;
//RegisterModel name changed to User
class Swap extends DbModel {
    public const IS_APPROVED = 1;
    public const  IS_NOT_APPROVED = 0;
   
    public int $id = 0;
    public int $product_received_id = -1;
    public int $product_sent_id = -1;
    public int $sender_id = -1;
    public int $receiver_id = -1;
    public int $isApprovedByReceiver = self::IS_NOT_APPROVED;
    public int $isDeclinedByReceiver = self::IS_NOT_APPROVED;

    public ?Product $productReceived = null;
    public ?Product $productSent = null;
    public ?User $sender = null;
    public ?User $receiver = null;

    public static function tableName(): string
    {
        return 'swaps';
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
        return ['id','product_received_id', 'product_sent_id', 'sender_id', 'receiver_id', 'isApprovedByReceiver'];
    }
}