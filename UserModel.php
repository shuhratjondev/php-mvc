<?php
/**
 * User: sh_abdurasulov
 * @package app\core
 */

namespace app\core;


use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;

}