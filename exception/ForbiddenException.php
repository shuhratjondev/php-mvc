<?php
/**
 * User: sh_abdurasulov
 * @package shuhratjon\mvc\exception
 */

namespace shuhratjon\mvc\exception;


use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;

}