<?php
/**
 * User: sh_abdurasulov
 * @package shuhratjon\mvc\exception
 */

namespace shuhratjon\mvc\exception;


use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Page Not Found';
    protected $code = 404;
}