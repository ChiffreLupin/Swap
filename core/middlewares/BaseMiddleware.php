<?php

/**
 * @author swapGroup
 * @package app\core\middleware;
 */

namespace app\core\middlewares;

abstract class BaseMiddleware {
    abstract public function execute();
}