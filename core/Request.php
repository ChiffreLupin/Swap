<?php
/**
    Class Request
    @package app\core
 */

namespace app\core;

class Request {
    public function __construct() {

    }

    public function getParam($param) {
        return $_GET[$param] ?? "";
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    // public function isGet() {
    //     return $this->getMethod() === 'get';
    // }

    // public function isPost() {
    //     return $this->getMethod() === 'post';
    // }

    public function getPath() {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($path, '?');
      

        if($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getBody() {
        $body = [];
        
        if($this->getMethod() === 'get') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        else if($this->getMethod() === 'post') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}