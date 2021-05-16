<?php

/**
    Class Response
    @package app\core
 */

namespace app\core;

class Response {
    public function setStatusCode(int $code) {
        http_response_code($code);
    }
}
