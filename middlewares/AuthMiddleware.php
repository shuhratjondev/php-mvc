<?php
/**
 * User: sh_abdurasulov
 * @package shuhratjon\mvc\middlewares
 */

namespace shuhratjon\mvc\middlewares;


use shuhratjon\mvc\Application;
use shuhratjon\mvc\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }


    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions, true)) {
                throw new ForbiddenException();
            }
            
        }
    }
}