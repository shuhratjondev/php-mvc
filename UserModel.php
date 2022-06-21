<?php
/**
 * User: sh_abdurasulov
 * @package shuhratjon\mvc
 */

namespace shuhratjon\mvc;


use shuhratjon\mvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;

}