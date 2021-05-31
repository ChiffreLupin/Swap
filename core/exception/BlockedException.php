<?php 

namespace app\core\exception;

class BlockedException extends \Exception {
    protected $code = 412;
    protected $message = "You have been blocked! Please contact us at projectrailway9@gmail.com!";
}