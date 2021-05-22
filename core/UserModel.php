<?php

/**
    Class UserModel
    @package app\core
 */

namespace app\core;

abstract class UserModel extends  DbModel{

    abstract function displayName(): string;
}
